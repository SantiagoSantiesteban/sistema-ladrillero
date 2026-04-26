<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmpleadorController extends Controller
{
    public function index()
    {
        return view('empleador.index');
    }

    public function buscarTrabajadores(Request $request)
    {
        $dias = $request->input('dias', []);

        $query = User::where(function($q) {
            $q->where('role', 'trabajador')
              ->orWhere('role', 'dual');
        })->whereHas('disponibilidad', function($q) use ($dias) {
            foreach ($dias as $dia) {
                $q->where($dia, true);
            }
        })->with('disponibilidad');

        $trabajadores = $query->get();

        return view('empleador.resultados', compact('trabajadores', 'dias'));
    }
}
