<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FechaDisponible;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TrabajadorController extends Controller
{
    public function index()
    {
        $hoy = Carbon::today();
        $limite = Carbon::today()->addDays(15);

        $fechasDisponibles = Auth::user()
            ->fechasDisponibles()
            ->whereBetween('fecha', [$hoy, $limite])
            ->where('disponible', true)
            ->pluck('fecha')
            ->map(fn($f) => $f->format('Y-m-d'))
            ->toArray();

        return view('trabajador.index', compact('fechasDisponibles', 'hoy', 'limite'));
    }

    public function editarDisponibilidad()
    {
        $hoy = Carbon::today();
        $limite = Carbon::today()->addDays(15);

        $fechasDisponibles = Auth::user()
            ->fechasDisponibles()
            ->whereBetween('fecha', [$hoy, $limite])
            ->pluck('fecha')
            ->map(fn($f) => $f->format('Y-m-d'))
            ->toArray();

        return view('trabajador.disponibilidad', compact('fechasDisponibles', 'hoy', 'limite'));
    }

    public function guardarDisponibilidad(Request $request)
    {
        $request->validate([
            'fechas' => 'nullable|array',
            'fechas.*' => 'date|after_or_equal:today',
        ]);

        $hoy = Carbon::today();
        $limite = Carbon::today()->addDays(15);

        // Eliminar disponibilidades anteriores en el rango
        Auth::user()
            ->fechasDisponibles()
            ->whereBetween('fecha', [$hoy, $limite])
            ->delete();

        // Guardar las nuevas fechas seleccionadas
        if ($request->fechas) {
            foreach ($request->fechas as $fecha) {
                $fechaCarbon = Carbon::parse($fecha);
                if ($fechaCarbon->between($hoy, $limite)) {
                    FechaDisponible::create([
                        'user_id' => Auth::id(),
                        'fecha' => $fecha,
                        'disponible' => true,
                    ]);
                }
            }
        }

        return redirect()->route('trabajador.index')
            ->with('success', 'Disponibilidad actualizada correctamente.');
    }
}