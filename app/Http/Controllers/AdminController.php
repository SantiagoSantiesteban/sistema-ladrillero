<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsuarios = User::count();
        $totalTrabajadores = User::where('role', 'trabajador')->orWhere('role', 'dual')->count();
        $totalEmpleadores = User::where('role', 'empleador')->orWhere('role', 'dual')->count();

        return view('admin.index', compact('totalUsuarios', 'totalTrabajadores', 'totalEmpleadores'));
    }

    public function usuarios()
    {
        $usuarios = User::all();
        return view('admin.usuarios', compact('usuarios'));
    }

    public function editarRol(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:trabajador,empleador,dual,admin',
        ]);

        $user->update(['role' => $request->role]);

        return redirect()->route('admin.usuarios')
            ->with('success', 'Rol actualizado correctamente.');
    }

    public function eliminarUsuario(User $user)
    {
        $user->delete();
        return redirect()->route('admin.usuarios')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}