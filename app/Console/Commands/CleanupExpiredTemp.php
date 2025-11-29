<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanupExpiredTemp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:expired-temp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up expired temporary preview folders (older than 24 hours)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $storage = app(\App\Services\TempStorageService::class);

        $count = $storage->cleanupExpired();

        $this->info("Cleaned up {$count} expired temporary folders");

        return 0;
    }
}
