<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\FileValidator;
use App\Services\TempStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    private TempStorageService $storage;
    private FileValidator $validator;

    public function __construct(
        TempStorageService $storage,
        FileValidator $validator
    ) {
        $this->storage = $storage;
        $this->validator = $validator;
    }

    /**
     * Show upload form
     */
    public function create()
    {
        return view('projects.upload');
    }

    /**
     * Handle file upload
     */
    public function store(Request $request)
    {
        $request->validate([
            'files' => 'nullable|array',
            'files.*' => 'file|max:51200', // 50MB per file
            'zip_file' => 'nullable|file|mimes:zip|max:51200',
        ]);

        try {
            // Create temp folder
            $tempFolder = $this->storage->createTempFolder();
            $fileSize = 0;

            // Handle ZIP upload
            if ($request->hasFile('zip_file')) {
                $fileSize = $this->storage->extractZip(
                    $request->file('zip_file'),
                    $tempFolder['path']
                );
            }
            // Handle individual files
            elseif ($request->hasFile('files')) {
                $fileSize = $this->storage->uploadFiles(
                    $request->file('files'),
                    $tempFolder['path']
                );
            } else {
                return back()->withErrors(['files' => 'Please upload at least one file or a ZIP archive']);
            }

            // Check if index.html exists
            if (!$this->storage->hasIndexFile($tempFolder['path'])) {
                $this->storage->deleteTempFolder($tempFolder['path']);
                return back()->withErrors([
                    'files' => 'Your upload must contain an index.html file'
                ]);
            }

            // Create project record
            $project = Project::create([
                'user_id' => Auth::id(),
                'temp_path' => $tempFolder['path'],
                'preview_token' => $tempFolder['token'],
                'status' => 'temp',
                'file_size' => $fileSize,
                'uploaded_at' => now(),
                'expires_at' => now()->addHours(24),
            ]);

            Log::info('Project uploaded', [
                'project_id' => $project->id,
                'user_id' => Auth::id(),
                'file_size' => $fileSize,
            ]);

            return redirect()->route('projects.preview', $project->preview_token)
                ->with('success', 'Files uploaded successfully! Preview your website below.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            Log::error('Upload failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return back()->withErrors(['error' => 'Upload failed: ' . $e->getMessage()]);
        }
    }

    /**
     * Show preview page
     */
    public function preview($token)
    {
        $project = Project::where('preview_token', $token)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Check if expired
        if ($project->isExpired()) {
            return view('projects.expired', compact('project'));
        }

        // Get index path
        $indexPath = $this->storage->getIndexPath($project->temp_path);

        return view('projects.preview', compact('project', 'indexPath'));
    }

    /**
     * List user's projects
     */
    public function index()
    {
        $projects = Auth::user()->projects()
            ->with(['order', 'domain'])
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Delete project
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        // Delete temp folder if exists
        if ($project->status === 'temp' && $project->temp_path) {
            $this->storage->deleteTempFolder($project->temp_path);
        }

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully');
    }
}
