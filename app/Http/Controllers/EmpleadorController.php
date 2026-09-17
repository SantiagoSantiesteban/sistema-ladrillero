<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FechaDisponible;
use Carbon\Carbon;

class EmpleadorController extends Controller
{
    public function index()
    {
        $hoy = Carbon::today();
        $limite = Carbon::today()->addDays(15);
        return view('empleador.index', compact('hoy', 'limite'));
    }

    public function buscarTrabajadores(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $fechaInicio = Carbon::parse($request->fecha_inicio);
        $fechaFin = $request->fecha_fin
            ? Carbon::parse($request->fecha_fin)
            : $fechaInicio;

        // Buscar trabajadores disponibles en el rango de fechas
        $trabajadores = User::where(function($q) {
                $q->where('role', 'trabajador')
                  ->orWhere('role', 'dual');
            })
            ->whereHas('fechasDisponibles', function($q) use ($fechaInicio, $fechaFin) {
                $q->whereBetween('fecha', [$fechaInicio, $fechaFin])
                  ->where('disponible', true);
            })
            ->with(['fechasDisponibles' => function($q) use ($fechaInicio, $fechaFin) {
                $q->whereBetween('fecha', [$fechaInicio, $fechaFin])
                  ->where('disponible', true)
                  ->orderBy('fecha');
            }])
            ->get();

        return view('empleador.resultados', compact(
            'trabajadores',
            'fechaInicio',
            'fechaFin'
        ));
    }
}
