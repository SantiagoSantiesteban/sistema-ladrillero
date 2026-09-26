<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'button_text',
        'button_url',
        'position',
        'is_active',
        'starts_at',
        'ends_at',
        'created_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at'   => 'datetime',
    ];

    /**
     * Scope para obtener únicamente banners que deben ser visibles públicamente:
     * - Deben estar marcados como activos (is_active = true)
     * - Fecha actual dentro del rango programado (si aplica)
     */
    public function scopeVisible($query)
    {
        $now = now();

        return $query->where('is_active', true)
            ->where(function ($q) use ($now) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', $now);
            })
            ->orderBy('position', 'asc')
            ->orderBy('created_at', 'desc');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}