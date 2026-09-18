<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Disponibilidad;

class OptimizacionController extends Controller
{
    public function medirConsultas()
    {
        if (!auth()->user()->esAdmin()) {
            abort(403, 'No autorizado');
        }
        $resultados = [];

        // Consulta 1: Buscar trabajadores por rol
        $inicio = microtime(true);
        $trabajadores = User::where('role', 'trabajador')
            ->orWhere('role', 'dual')
            ->get();
        $fin = microtime(true);
        $resultados['buscar_por_rol'] = [
            'descripcion' => 'Buscar todos los trabajadores por rol',
            'tiempo_ms' => round(($fin - $inicio) * 1000, 4),
            'resultados' => $trabajadores->count()
        ];

        // Consulta 2: Buscar disponibilidad por dias
        $inicio = microtime(true);
        $disponibles = Disponibilidad::where('lunes', true)
            ->where('miercoles', true)
            ->with('user')
            ->get();
        $fin = microtime(true);
        $resultados['buscar_disponibilidad'] = [
            'descripcion' => 'Buscar trabajadores disponibles lunes y miercoles',
            'tiempo_ms' => round(($fin - $inicio) * 1000, 4),
            'resultados' => $disponibles->count()
        ];

        // Consulta 3: Buscar usuario por email
        $inicio = microtime(true);
        $usuario = User::where('email', 'test@test.com')->first();
        $fin = microtime(true);
        $resultados['buscar_por_email'] = [
            'descripcion' => 'Buscar usuario por email',
            'tiempo_ms' => round(($fin - $inicio) * 1000, 4),
            'resultados' => $usuario ? 1 : 0
        ];

        // Consulta 4: Contar usuarios por rol (para el admin)
        $inicio = microtime(true);
        $conteo = User::selectRaw('role, count(*) as total')
            ->groupBy('role')
            ->get();
        $fin = microtime(true);
        $resultados['contar_por_rol'] = [
            'descripcion' => 'Contar usuarios agrupados por rol',
            'tiempo_ms' => round(($fin - $inicio) * 1000, 4),
            'resultados' => $conteo->count()
        ];

        return view('optimizacion.resultados', compact('resultados'));
    }
}