<?php

use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\EmpleadorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OptimizacionController;
use App\Http\Controllers\ReceivedEmailController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AboutSectionController;

// Ruta pública de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas públicas del Sector Ladrillero
Route::prefix('sector')->name('sector.')->group(function () {
    Route::get('/', [SectorController::class, 'index'])->name('index');
    Route::get('/productos', [SectorController::class, 'productos'])->name('productos');
    Route::get('/nosotros', [SectorController::class, 'nosotros'])->name('nosotros'); // Ruta agregada para el Módulo 3
    Route::get('/contacto', [SectorController::class, 'contacto'])->name('contacto');
});

// Rutas de perfil de Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard general con redirección por rol
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

// Rutas Trabajador
Route::middleware('auth')->prefix('trabajador')->name('trabajador.')->group(function () {
    Route::get('/', [TrabajadorController::class, 'index'])->name('index');
    Route::get('/disponibilidad', [TrabajadorController::class, 'editarDisponibilidad'])->name('disponibilidad');
    Route::post('/disponibilidad', [TrabajadorController::class, 'guardarDisponibilidad'])->name('disponibilidad.guardar');
});

// Rutas Empleador
Route::middleware('auth')->prefix('empleador')->name('empleador.')->group(function () {
    Route::get('/', [EmpleadorController::class, 'index'])->name('index');
    Route::get('/buscar', [EmpleadorController::class, 'buscarTrabajadores'])->name('buscar');
});

// Rutas Admin
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('usuarios');
    Route::patch('/usuarios/{user}/rol', [AdminController::class, 'editarRol'])->name('usuarios.rol');
    Route::delete('/usuarios/{user}', [AdminController::class, 'eliminarUsuario'])->name('usuarios.eliminar');
    Route::get('/optimizacion', [OptimizacionController::class, 'medirConsultas'])->name('optimizacion');
});

// Rutas protegidas de gestión administrativa (Banners, Servicios, Nosotros, Correos)
Route::middleware(['auth'])->group(function () {
    Route::get('/correos', [ReceivedEmailController::class, 'index'])->name('emails.index');
    Route::get('/correos/{id}', [ReceivedEmailController::class, 'show'])->name('emails.show');

    Route::resource('admin/banners', BannerController::class)->names([
        'index'   => 'admin.banners.index',
        'create'  => 'admin.banners.create',
        'store'   => 'admin.banners.store',
        'edit'    => 'admin.banners.edit',
        'update'  => 'admin.banners.update',
        'destroy' => 'admin.banners.destroy',
    ]);

    Route::resource('admin/services', ServiceController::class)->names([
        'index'   => 'admin.services.index',
        'create'  => 'admin.services.create',
        'store'   => 'admin.services.store',
        'edit'    => 'admin.services.edit',
        'update'  => 'admin.services.update',
        'destroy' => 'admin.services.destroy',
    ]);

    Route::resource('admin/about', AboutSectionController::class)->names([
        'index'   => 'admin.about.index',
        'create'  => 'admin.about.create',
        'store'   => 'admin.about.store',
        'edit'    => 'admin.about.edit',
        'update'  => 'admin.about.update',
        'destroy' => 'admin.about.destroy',
    ]);
});

// Formulario de Contacto Público
Route::get('/contacto', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contacto', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

require __DIR__.'/auth.php';