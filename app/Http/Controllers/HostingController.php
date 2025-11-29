<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class HostingController extends Controller
{
    /**
     * Serve hosted website files
     */
    public function serve($domainName, Request $request)
    {
        // Find active domain
        $domain = Domain::where('domain_name', $domainName)
            ->where('is_active', true)
            ->with('project')
            ->firstOrFail();

        $project = $domain->project;

        // Get requested path (default to index.html)
        $path = $request->path();
        $path = str_replace("hosting/{$domainName}", '', $path);
        $path = trim($path, '/') ?: 'index.html';

        // Build full file path
        $fullPath = storage_path("app/{$project->final_path}/{$path}");

        // Security check: prevent directory traversal
        $realPath = realpath($fullPath);
        $basePath = realpath(storage_path("app/{$project->final_path}"));

        if (!$realPath || !str_starts_with($realPath, $basePath)) {
            abort(403, 'Access denied');
        }

        // Check if file exists
        if (!File::exists($realPath) || File::isDirectory($realPath)) {
            abort(404, 'File not found');
        }

        // Get MIME type
        $mimeType = File::mimeType($realPath);

        // Serve file with appropriate headers
        return Response::file($realPath, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
