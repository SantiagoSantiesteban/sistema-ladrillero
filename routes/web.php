<?php

use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\EmpleadorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Ruta publica
Route::get('/', function () {
    return view('welcome');
});

// Rutas de perfil de Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard general
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->esAdmin()) {
        return redirect()->route('admin.index');
    } elseif ($user->esEmpleador() && !$user->esTrabajador()) {
        return redirect()->route('empleador.index');
    } else {
        return redirect()->route('trabajador.index');
    }
})->middleware('auth')->name('dashboard');

// Rutas trabajador
Route::middleware('auth')->prefix('trabajador')->name('trabajador.')->group(function () {
    Route::get('/', [TrabajadorController::class, 'index'])->name('index');
    Route::get('/disponibilidad', [TrabajadorController::class, 'editarDisponibilidad'])->name('disponibilidad');
    Route::post('/disponibilidad', [TrabajadorController::class, 'guardarDisponibilidad'])->name('disponibilidad.guardar');
});

// Rutas empleador
Route::middleware('auth')->prefix('empleador')->name('empleador.')->group(function () {
    Route::get('/', [EmpleadorController::class, 'index'])->name('index');
    Route::get('/buscar', [EmpleadorController::class, 'buscarTrabajadores'])->name('buscar');
});

// Rutas admin
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('usuarios');
    Route::patch('/usuarios/{user}/rol', [AdminController::class, 'editarRol'])->name('usuarios.rol');
    Route::delete('/usuarios/{user}', [AdminController::class, 'eliminarUsuario'])->name('usuarios.eliminar');
});

require __DIR__.'/auth.php';