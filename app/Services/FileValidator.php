<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class FileValidator
{
    /**
     * Blocked file extensions
     */
    private const BLOCKED_EXTENSIONS = [
        'php',
        'phar',
        'phtml',
        'php3',
        'php4',
        'php5',
        'exe',
        'bat',
        'cmd',
        'sh',
        'bash',
        'dll',
        'so',
        'dylib',
        'jar',
        'class',
        'vbs',
        'vbe',
        // 'js', // Allowed for static hosting
        'jse',
        'reg',
        'msi',
        'scr',
        'asp',
        'aspx',
        'jsp',
        'cgi',
        'pl',
    ];

    /**
     * Allowed MIME types
     */
    private const ALLOWED_MIMES = [
        'text/html',
        'text/css',
        'text/javascript',
        'application/javascript',
        'text/plain',
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/svg+xml',
        'image/webp',
        'image/bmp',
        'image/x-icon',
        'font/woff',
        'font/woff2',
        'font/ttf',
        'font/otf',
        'application/json',
        'application/xml',
        'text/xml',
        'application/zip',
        'application/x-zip-compressed',
    ];

    /**
     * Maximum file size in bytes (50MB default)
     */
    private int $maxFileSize;

    public function __construct(int $maxFileSize = 52428800) // 50MB
    {
        $this->maxFileSize = $maxFileSize;
    }

    /**
     * Validate a single uploaded file
     *
     * @throws ValidationException
     */
    public function validate(UploadedFile $file): bool
    {
        // Check file size
        if ($file->getSize() > $this->maxFileSize) {
            throw ValidationException::withMessages([
                'file' => ["File size exceeds maximum limit of " . $this->formatBytes($this->maxFileSize)],
            ]);
        }

        // Get file extension
        $extension = strtolower($file->getClientOriginalExtension());

        // Check blocked extensions
        if (in_array($extension, self::BLOCKED_EXTENSIONS)) {
            throw ValidationException::withMessages([
                'file' => ["File type .{$extension} is not allowed for security reasons."],
            ]);
        }

        // Check MIME type for non-ZIP files
        $mimeType = $file->getMimeType();
        if ($extension !== 'zip' && !in_array($mimeType, self::ALLOWED_MIMES)) {
            throw ValidationException::withMessages([
                'file' => ["File MIME type {$mimeType} is not allowed."],
            ]);
        }

        return true;
    }

    /**
     * Validate ZIP file contents
     *
     * @throws ValidationException
     */
    public function validateZipContents(string $extractPath): bool
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($extractPath)
        );

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $extension = strtolower($file->getExtension());

                // Check for blocked extensions
                if (in_array($extension, self::BLOCKED_EXTENSIONS)) {
                    throw ValidationException::withMessages([
                        'zip' => ["ZIP contains blocked file type: .{$extension}"],
                    ]);
                }

                // Basic content scan for PHP tags
                if (in_array($extension, ['html', 'htm', 'css', 'js', 'txt'])) {
                    $content = file_get_contents($file->getRealPath());
                    if ($this->containsPhpCode($content)) {
                        throw ValidationException::withMessages([
                            'zip' => ["Potentially dangerous PHP code detected in file: {$file->getFilename()}"],
                        ]);
                    }
                }
            }
        }

        return true;
    }

    /**
     * Check if content contains PHP code
     */
    private function containsPhpCode(string $content): bool
    {
        // Check for PHP tags
        if (preg_match('/<\?php|<\?=|\?>/i', $content)) {
            return true;
        }

        // Check for suspicious functions
        $dangerousFunctions = ['eval', 'exec', 'system', 'shell_exec', 'passthru', 'proc_open', 'popen'];
        foreach ($dangerousFunctions as $func) {
            if (stripos($content, $func . '(') !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));

        return round($bytes, 2) . ' ' . $units[$pow];
    }
}
