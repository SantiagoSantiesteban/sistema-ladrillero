<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'es_empleador',
        'telefono',
        'direccion',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'es_empleador' => 'boolean',
        ];
    }

    public function esTrabajador(): bool
    {
        return $this->role === 'trabajador' || $this->role === 'dual';
    }

    public function esEmpleador(): bool
    {
        return $this->role === 'empleador' || $this->role === 'dual' || $this->es_empleador;
    }

    public function esAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function disponibilidad()
    {
        return $this->hasOne(Disponibilidad::class);
    }
}