<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // Obtener los valores sin importar si vienen de la web (rol/phone) o de los tests (role/telefono)
        $rolInput = $request->input('rol') ?? $request->input('role');
        $phoneInput = $request->input('phone') ?? $request->input('telefono');

        // Reemplazarlos en el request para pasar la validación
        $request->merge([
            'rol' => $rolInput,
            'role' => $rolInput,
            'phone' => $phoneInput,
            'telefono' => $phoneInput,
        ]);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'rol' => ['required', 'in:trabajador,empleador,dual'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $rolInput,
            'telefono' => $phoneInput,
            'es_empleador' => in_array($rolInput, ['empleador', 'dual']),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}