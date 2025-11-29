<?php

namespace App\Services;

use App\Models\Domain;
use App\Models\Project;
use Illuminate\Support\Str;

class DomainService
{
    /**
     * Check if domain name is available
     */
    public function isAvailable(string $domainName): bool
    {
        $slug = $this->slugify($domainName);

        return !Domain::where('domain_name', $slug)->exists() &&
            !Project::where('domain_name', $slug)->exists();
    }

    /**
     * Validate domain name format
     */
    public function validate(string $domainName): array
    {
        $errors = [];

        // Check length
        if (strlen($domainName) < 3) {
            $errors[] = 'Domain name must be at least 3 characters long';
        }

        if (strlen($domainName) > 63) {
            $errors[] = 'Domain name must be less than 63 characters';
        }

        // Check format (alphanumeric and hyphens only)
        if (!preg_match('/^[a-z0-9-]+$/i', $domainName)) {
            $errors[] = 'Domain name can only contain letters, numbers, and hyphens';
        }

        // Cannot start or end with hyphen
        if (preg_match('/^-|-$/', $domainName)) {
            $errors[] = 'Domain name cannot start or end with a hyphen';
        }

        // Reserved names
        $reserved = ['www', 'mail', 'ftp', 'admin', 'api', 'cdn', 'preview', 'hosting'];
        if (in_array(strtolower($domainName), $reserved)) {
            $errors[] = 'This domain name is reserved';
        }

        return $errors;
    }

    /**
     * Slugify domain name
     */
    public function slugify(string $domainName): string
    {
        return Str::slug($domainName, '-');
    }

    /**
     * Reserve domain for a project (when order is created)
     */
    public function reserve(Project $project, string $domainName): bool
    {
        $slug = $this->slugify($domainName);

        if (!$this->isAvailable($slug)) {
            return false;
        }

        $project->update(['domain_name' => $slug]);

        return true;
    }

    /**
     * Activate domain (create Domain record)
     */
    public function activate(Project $project): Domain
    {
        return Domain::create([
            'domain_name' => $project->domain_name,
            'project_id' => $project->id,
            'user_id' => $project->user_id,
            'is_active' => true,
            'activated_at' => now(),
        ]);
    }

    /**
     * Deactivate domain
     */
    public function deactivate(Domain $domain): bool
    {
        return $domain->update(['is_active' => false]);
    }

    /**
     * Get full domain URL
     */
    public function getFullDomain(string $domainName): string
    {
        return "{$domainName}.zone.id";
    }
}
