<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disponibilidad;
use Illuminate\Support\Facades\Auth;

class TrabajadorController extends Controller
{
    public function index()
    {
        $disponibilidad = Auth::user()->disponibilidad;
        return view('trabajador.index', compact('disponibilidad'));
    }

    public function editarDisponibilidad()
    {
        $disponibilidad = Auth::user()->disponibilidad;
        return view('trabajador.disponibilidad', compact('disponibilidad'));
    }

    public function guardarDisponibilidad(Request $request)
    {
        $datos = $request->validate([
            'lunes' => 'boolean',
            'martes' => 'boolean',
            'miercoles' => 'boolean',
            'jueves' => 'boolean',
            'viernes' => 'boolean',
            'sabado' => 'boolean',
            'domingo' => 'boolean',
            'descripcion' => 'nullable|string|max:500',
        ]);

        $datos['lunes'] = $request->has('lunes');
        $datos['martes'] = $request->has('martes');
        $datos['miercoles'] = $request->has('miercoles');
        $datos['jueves'] = $request->has('jueves');
        $datos['viernes'] = $request->has('viernes');
        $datos['sabado'] = $request->has('sabado');
        $datos['domingo'] = $request->has('domingo');

        Disponibilidad::updateOrCreate(
            ['user_id' => Auth::id()],
            $datos
        );

        return redirect()->route('trabajador.index')
            ->with('success', 'Disponibilidad actualizada correctamente.');
    }
}