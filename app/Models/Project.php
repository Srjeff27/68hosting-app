<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'domain_name',
        'temp_path',
        'final_path',
        'preview_token',
        'status',
        'file_size',
        'uploaded_at',
        'expires_at',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
        'expires_at' => 'datetime',
        'file_size' => 'integer',
    ];

    /**
     * Get the user that owns the project
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order for this project
     */
    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }

    /**
     * Get the domain for this project
     */
    public function domain(): HasOne
    {
        return $this->hasOne(Domain::class);
    }

    /**
     * Get the preview URL
     */
    public function getPreviewUrlAttribute(): string
    {
        return url("/preview/{$this->preview_token}");
    }

    /**
     * Check if project is expired
     */
    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    /**
     * Check if project is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if project is waiting for payment
     */
    public function isWaitingPayment(): bool
    {
        return $this->status === 'waiting_payment';
    }
}
