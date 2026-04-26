<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disponibilidad extends Model
{
    protected $fillable = [
        'user_id',
        'lunes',
        'martes',
        'miercoles',
        'jueves',
        'viernes',
        'sabado',
        'domingo',
        'descripcion',
    ];

    protected $casts = [
        'lunes' => 'boolean',
        'martes' => 'boolean',
        'miercoles' => 'boolean',
        'jueves' => 'boolean',
        'viernes' => 'boolean',
        'sabado' => 'boolean',
        'domingo' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}