<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Usuarios de prueba (solo para entornos locales y de demostración).
     */
    public function run(): void
    {
        $clave = 'Ladrillo2026!';

        $usuarios = [
            ['name' => 'Administrador Prueba', 'email' => 'admin@ladrilloweb.test', 'role' => 'admin', 'es_empleador' => false, 'telefono' => '3000000001'],
            ['name' => 'Empleador Prueba', 'email' => 'empleador@ladrilloweb.test', 'role' => 'empleador', 'es_empleador' => true, 'telefono' => '3000000002'],
            ['name' => 'Trabajador Prueba', 'email' => 'trabajador@ladrilloweb.test', 'role' => 'trabajador', 'es_empleador' => false, 'telefono' => '3000000003'],
        ];

        foreach ($usuarios as $datos) {
            User::updateOrCreate(
                ['email' => $datos['email']],
                $datos + ['password' => $clave]
            );
        }

        // El trabajador de prueba queda disponible los próximos 3 días.
        $trabajador = User::where('email', 'trabajador@ladrilloweb.test')->first();
        foreach ([1, 2, 3] as $dias) {
            DB::table('fechas_disponibles')->updateOrInsert(
                ['user_id' => $trabajador->id, 'fecha' => now()->addDays($dias)->toDateString()],
                ['disponible' => 1, 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
