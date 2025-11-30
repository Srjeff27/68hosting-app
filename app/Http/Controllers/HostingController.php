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
    public function serve($domainName, $path = null)
    {
        // Find active domain
        $domain = Domain::where('domain_name', $domainName)
            ->where('is_active', true)
            ->with('project')
            ->firstOrFail();

        $project = $domain->project;

        // Default to index.html if path is empty
        $path = $path ?: 'index.html';

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
            $found = false;

            // Fallback: Try to find the file in the root if it was requested in a subdirectory
            if (!$found) {
                $basename = basename($path);
                $rootPath = $basePath . '/' . $basename;
                if (File::exists($rootPath) && !File::isDirectory($rootPath)) {
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

        // Serve file with appropriate headers
        return Response::file($realPath, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
