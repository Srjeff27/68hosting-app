<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_name',
        'project_id',
        'user_id',
        'is_active',
        'activated_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'activated_at' => 'datetime',
    ];

    /**
     * Get the project that owns the domain
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the user that owns the domain
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to only include active domains
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the full domain URL
     */
    public function getFullDomainAttribute(): string
    {
        return "{$this->domain_name}.zone.id";
    }
}
