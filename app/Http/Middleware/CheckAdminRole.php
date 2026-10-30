<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        // Aquí usamos el método esAdmin() que ya tienes programado en tu modelo User
        if (Auth::check() && Auth::user()->esAdmin()) {
            return $next($request);
        }

        // Usamos redirect explícito para asegurar que nunca haya bucles de redirección
        return redirect('/dashboard')->with('error', 'Acceso denegado: Área exclusiva de administración.');
    }
}