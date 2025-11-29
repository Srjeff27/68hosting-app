<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('domain_name')->nullable()->unique();
            $table->string('temp_path'); // e.g., temp/abc123xyz
            $table->string('final_path')->nullable(); // e.g., hosting/mydomain
            $table->string('preview_token')->unique(); // UUID for preview URL
            $table->enum('status', ['temp', 'waiting_payment', 'active', 'rejected', 'expired'])->default('temp');
            $table->unsignedBigInteger('file_size')->default(0); // in bytes
            $table->timestamp('uploaded_at')->useCurrent();
            $table->timestamp('expires_at')->nullable(); // 24 hours from upload
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('preview_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
