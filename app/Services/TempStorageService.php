<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class TempStorageService
{
    private FileValidator $validator;

    public function __construct(FileValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Create temporary folder for uploaded files
     */
    public function createTempFolder(): array
    {
        $token = Str::random(32);
        $tempPath = "temp/{$token}";

        // Create directory in storage
        Storage::disk('local')->makeDirectory($tempPath);

        return [
            'token' => $token,
            'path' => $tempPath,
            'full_path' => storage_path("app/{$tempPath}"),
        ];
    }

    /**
     * Handle file upload (single or multiple files)
     */
    public function uploadFiles(array $files, string $tempPath): int
    {
        $totalSize = 0;

        foreach ($files as $file) {
            // Validate each file
            $this->validator->validate($file);

            // Store file
            $filename = $file->getClientOriginalName();
            $file->storeAs($tempPath, $filename);

            $totalSize += $file->getSize();
        }

        return $totalSize;
    }

    /**
     * Extract ZIP file to temp folder
     */
    public function extractZip(UploadedFile $zipFile, string $tempPath): int
    {
        // Validate ZIP file
        $this->validator->validate($zipFile);

        $zip = new ZipArchive();
        $fullPath = storage_path("app/{$tempPath}");
        $zipPath = $zipFile->getRealPath();

        if ($zip->open($zipPath) === true) {
            $zip->extractTo($fullPath);
            $zip->close();

            // Validate extracted contents
            $this->validator->validateZipContents($fullPath);

            // Calculate total size
            return $this->calculateDirectorySize($fullPath);
        }

        throw new \Exception('Failed to extract ZIP file');
    }

    /**
     * Calculate directory size recursively
     */
    private function calculateDirectorySize(string $path): int
    {
        $size = 0;
        foreach (File::allFiles($path) as $file) {
            $size += $file->getSize();
        }
        return $size;
    }

    /**
     * Move files from temp to final hosting folder
     */
    public function moveToFinal(Project $project, string $domainName): string
    {
        $finalPath = "hosting/{$domainName}";
        $tempFullPath = storage_path("app/{$project->temp_path}");
        $finalFullPath = storage_path("app/{$finalPath}");

        // Create final directory
        if (!File::exists($finalFullPath)) {
            File::makeDirectory($finalFullPath, 0755, true);
        }

        // Copy all files from temp to final
        File::copyDirectory($tempFullPath, $finalFullPath);

        return $finalPath;
    }

    /**
     * Delete temporary folder
     */
    public function deleteTempFolder(string $tempPath): bool
    {
        return Storage::disk('local')->deleteDirectory($tempPath);
    }

    /**
     * Cleanup expired temp folders
     */
    public function cleanupExpired(): int
    {
        $expiredProjects = Project::where('status', 'temp')
            ->where('expires_at', '<', now())
            ->get();

        $count = 0;
        foreach ($expiredProjects as $project) {
            if ($this->deleteTempFolder($project->temp_path)) {
                $project->update(['status' => 'expired']);
                $count++;
            }
        }

        return $count;
    }

    /**
     * Check if index.html exists in folder
     */
    public function hasIndexFile(string $tempPath): bool
    {
        $fullPath = storage_path("app/{$tempPath}");

        // Check for index.html in root
        if (File::exists("{$fullPath}/index.html")) {
            return true;
        }

        // Check for index.html in first subdirectory (common in extracted ZIPs)
        $directories = File::directories($fullPath);
        if (count($directories) === 1) {
            $subDir = $directories[0];
            if (File::exists("{$subDir}/index.html")) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the correct path to index.html
     */
    public function getIndexPath(string $tempPath): ?string
    {
        $fullPath = storage_path("app/{$tempPath}");

        // Check root
        if (File::exists("{$fullPath}/index.html")) {
            return '/index.html';
        }

        // Check first subdirectory
        $directories = File::directories($fullPath);
        if (count($directories) === 1) {
            $subDirName = basename($directories[0]);
            if (File::exists("{$directories[0]}/index.html")) {
                return "/{$subDirName}/index.html";
            }
        }

        return null;
    }
}
