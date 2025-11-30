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
    public function show($token, $path = null)
    {
        // Find project by token
        $project = Project::where('preview_token', $token)->firstOrFail();

        // Check if expired
        if ($project->isExpired()) {
            abort(410, 'Preview has expired');
        }

        // Default to index.html if path is empty
        $path = $path ?: 'index.html';

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
            $found = false;

            // Try in subdirectory (common ZIP structure)
            $directories = File::directories($basePath);
            if (count($directories) === 1) {
                $subPath = $directories[0] . '/' . $path;
                if (File::exists($subPath)) {
                    $realPath = $subPath;
                    $found = true;
                }
            }

            // Fallback: Try to find the file in the root if it was requested in a subdirectory
            // This handles cases where users upload flat files but index.html references folders (e.g. css/style.css -> style.css)
            if (!$found) {
                $basename = basename($path);
                $rootPath = $basePath . '/' . $basename;
                if (File::exists($rootPath)) {
                    $realPath = $rootPath;
                    $found = true;
                }
            }

            if (!$found) {
                abort(404, 'File not found');
            }
        }

        // Get MIME type
        $extension = strtolower(pathinfo($realPath, PATHINFO_EXTENSION));
        $mimeTypes = [
            'html' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
            'ico' => 'image/x-icon',
            'woff' => 'font/woff',
            'woff2' => 'font/woff2',
            'ttf' => 'font/ttf',
            'otf' => 'font/otf',
        ];

        $mimeType = $mimeTypes[$extension] ?? File::mimeType($realPath);

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
