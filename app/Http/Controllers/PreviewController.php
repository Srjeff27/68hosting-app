<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class PreviewController extends Controller
{
    /**
     * Serve preview files
     */
    public function show($token, Request $request)
    {
        // Find project by token
        $project = Project::where('preview_token', $token)->firstOrFail();

        // Check if expired
        if ($project->isExpired()) {
            abort(410, 'Preview has expired');
        }

        // Get requested path (default to index.html)
        $path = $request->path();
        $path = str_replace("preview/{$token}", '', $path);
        $path = trim($path, '/') ?: 'index.html';

        // Build full file path
        $fullPath = storage_path("app/{$project->temp_path}/{$path}");

        // Security check: prevent directory traversal
        $realPath = realpath($fullPath);
        $basePath = realpath(storage_path("app/{$project->temp_path}"));

        if (!$realPath || !str_starts_with($realPath, $basePath)) {
            abort(403, 'Access denied');
        }

        // Check if file exists
        if (!File::exists($realPath)) {
            // Try in subdirectory (common ZIP structure)
            $directories = File::directories($basePath);
            if (count($directories) === 1) {
                $subPath = $directories[0] . '/' . $path;
                if (File::exists($subPath)) {
                    $realPath = $subPath;
                } else {
                    abort(404, 'File not found');
                }
            } else {
                abort(404, 'File not found');
            }
        }

        // Get MIME type
        $mimeType = File::mimeType($realPath);

        // Serve file with security headers
        return Response::file($realPath, [
            'Content-Type' => $mimeType,
            'X-Frame-Options' => 'SAMEORIGIN',
            'X-Content-Type-Options' => 'nosniff',
            'X-XSS-Protection' => '1; mode=block',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'X-Robots-Tag' => 'noindex, nofollow',
        ]);
    }
}
