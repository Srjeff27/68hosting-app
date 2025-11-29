<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeploymentService
{
    private TempStorageService $storage;
    private DomainService $domainService;

    public function __construct(
        TempStorageService $storage,
        DomainService $domainService
    ) {
        $this->storage = $storage;
        $this->domainService = $domainService;
    }

    /**
     * Deploy project to hosting (called when order is approved)
     */
    public function deploy(Order $order): bool
    {
        try {
            DB::beginTransaction();

            $project = $order->project;

            // 1. Move files from temp to final hosting folder
            $finalPath = $this->storage->moveToFinal($project, $order->domain_name);

            // 2. Update project record
            $project->update([
                'final_path' => $finalPath,
                'domain_name' => $order->domain_name,
                'status' => 'active',
            ]);

            // 3. Activate domain
            $this->domainService->activate($project);

            // 4. Delete temp folder
            $this->storage->deleteTempFolder($project->temp_path);

            DB::commit();

            Log::info("Project deployed successfully", [
                'project_id' => $project->id,
                'domain' => $order->domain_name,
                'user_id' => $project->user_id,
            ]);

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error("Project deployment failed", [
                'project_id' => $project->id ?? null,
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Undeploy project (deactivate)
     */
    public function undeploy(Project $project): bool
    {
        try {
            DB::beginTransaction();

            // Deactivate domain
            if ($project->domain) {
                $this->domainService->deactivate($project->domain);
            }

            // Update project status
            $project->update(['status' => 'rejected']);

            DB::commit();

            Log::info("Project undeployed", [
                'project_id' => $project->id,
                'domain' => $project->domain_name,
            ]);

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error("Project undeployment failed", [
                'project_id' => $project->id,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}
