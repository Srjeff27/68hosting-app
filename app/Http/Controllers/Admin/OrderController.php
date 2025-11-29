<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = \App\Models\Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(\App\Models\Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,failed,cancelled,approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $order->update($validated);

        // Sync project status based on order status
        if ($order->project) {
            if (in_array($validated['status'], ['paid', 'approved'])) {
                $order->project->update(['status' => 'active']);
            } elseif (in_array($validated['status'], ['cancelled', 'rejected', 'failed'])) {
                $order->project->update(['status' => 'rejected']);
            }
        }

        return back()->with('success', 'Order updated successfully.');
    }

    /**
     * Download project files
     */
    public function downloadProject(\App\Models\Order $order)
    {
        $project = $order->project;

        if (!$project) {
            return back()->with('error', 'No project associated with this order.');
        }

        $path = $project->temp_path; // Or final_path if active
        if ($project->status === 'active' && $project->final_path) {
            $path = $project->final_path;
        }

        $fullPath = storage_path("app/{$path}");

        if (!\Illuminate\Support\Facades\File::exists($fullPath)) {
            return back()->with('error', 'Project files not found.');
        }

        // Create a temporary zip file
        $zipFileName = 'project-' . $project->id . '-' . time() . '.zip';
        $zipPath = storage_path("app/temp/{$zipFileName}");

        // Ensure temp directory exists
        if (!\Illuminate\Support\Facades\File::exists(dirname($zipPath))) {
            \Illuminate\Support\Facades\File::makeDirectory(dirname($zipPath), 0755, true);
        }

        $zip = new \ZipArchive;
        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($fullPath),
                \RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) {
                // Skip directories (they would be added automatically)
                if (!$file->isDir()) {
                    // Get real and relative path for current file
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($fullPath) + 1);

                    // Add current file to archive
                    $zip->addFile($filePath, $relativePath);
                }
            }

            $zip->close();
        } else {
            return back()->with('error', 'Failed to create zip file.');
        }

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
