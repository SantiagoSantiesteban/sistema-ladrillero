<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'icon',
        'image',
        'button_text',
        'button_url',
        'position',
        'is_active',
        'seo_title',
        'meta_description',
        'created_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Mutador para formatear o autogenerar el slug
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value ?: $this->name);
    }

    /**
     * Scope para consultar únicamente productos/servicios activos en el frontend público
     */
    public function scopeVisible($query)
    {
        return $query->where('is_active', true)
            ->orderBy('position', 'asc')
            ->orderBy('created_at', 'desc');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}