<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FechaDisponible extends Model
{
    protected $table = 'fechas_disponibles';

    protected $fillable = [
        'user_id',
        'fecha',
        'disponible',
        'nota',
    ];

    protected $casts = [
        'fecha' => 'date',
        'disponible' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}