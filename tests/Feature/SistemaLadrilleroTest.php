<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\FechaDisponible;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Tests\TestCase;

class SistemaLadrilleroTest extends TestCase
{
    use RefreshDatabase;

    public function test_trabajador_puede_registrarse()
    {
        $response = $this->post('/register', [
            'name' => 'Juan Trabajador',
            'email' => 'juan@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'trabajador',
            'telefono' => '3001234567',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', [
            'email' => 'juan@test.com',
            'role' => 'trabajador',
        ]);
    }

    public function test_empleador_puede_registrarse()
    {
        $response = $this->post('/register', [
            'name' => 'Carlos Empleador',
            'email' => 'carlos@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'empleador',
            'telefono' => '3009876543',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', [
            'email' => 'carlos@test.com',
            'role' => 'empleador',
        ]);
    }

    public function test_seccion_publica_accesible_sin_login()
    {
        $response = $this->get('/sector');
        $response->assertStatus(200);
    }

    public function test_panel_trabajador_requiere_autenticacion()
    {
        $response = $this->get('/trabajador');
        $response->assertRedirect('/login');
    }

    public function test_panel_empleador_requiere_autenticacion()
    {
        $response = $this->get('/empleador');
        $response->assertRedirect('/login');
    }

    // ---------------------------------------------------------------
    // Disponibilidad del trabajador (FechaDisponible)
    // ---------------------------------------------------------------

    public function test_trabajador_puede_guardar_disponibilidad()
    {
        $user = User::factory()->create(['role' => 'trabajador']);

        $fecha1 = Carbon::tomorrow()->format('Y-m-d');
        $fecha2 = Carbon::tomorrow()->addDays(2)->format('Y-m-d');

        $response = $this->actingAs($user)->post('/trabajador/disponibilidad', [
            'fechas' => [$fecha1, $fecha2],
        ]);

        $response->assertRedirect(route('trabajador.index'));
        $this->assertDatabaseHas('fechas_disponibles', [
            'user_id' => $user->id,
            'fecha' => $fecha1,
            'disponible' => 1,
        ]);
        $this->assertDatabaseHas('fechas_disponibles', [
            'user_id' => $user->id,
            'fecha' => $fecha2,
            'disponible' => 1,
        ]);
    }

    public function test_guardar_disponibilidad_reemplaza_fechas_anteriores()
    {
        $user = User::factory()->create(['role' => 'trabajador']);

        FechaDisponible::create([
            'user_id' => $user->id,
            'fecha' => Carbon::tomorrow(),
            'disponible' => true,
        ]);

        $nuevaFecha = Carbon::tomorrow()->addDays(5)->format('Y-m-d');

        $this->actingAs($user)->post('/trabajador/disponibilidad', [
            'fechas' => [$nuevaFecha],
        ]);

        $this->assertDatabaseMissing('fechas_disponibles', [
            'user_id' => $user->id,
            'fecha' => Carbon::tomorrow()->format('Y-m-d'),
        ]);
        $this->assertDatabaseHas('fechas_disponibles', [
            'user_id' => $user->id,
            'fecha' => $nuevaFecha,
        ]);
    }

    public function test_guardar_disponibilidad_rechaza_fecha_pasada()
    {
        $user = User::factory()->create(['role' => 'trabajador']);

        $response = $this->actingAs($user)->post('/trabajador/disponibilidad', [
            'fechas' => [Carbon::yesterday()->format('Y-m-d')],
        ]);

        $response->assertSessionHasErrors('fechas.0');
    }

    public function test_guardar_disponibilidad_vacia_borra_todo()
    {
        $user = User::factory()->create(['role' => 'trabajador']);

        FechaDisponible::create([
            'user_id' => $user->id,
            'fecha' => Carbon::tomorrow(),
            'disponible' => true,
        ]);

        $response = $this->actingAs($user)->post('/trabajador/disponibilidad', [
            'fechas' => [],
        ]);

        $response->assertRedirect(route('trabajador.index'));
        $this->assertDatabaseMissing('fechas_disponibles', [
            'user_id' => $user->id,
        ]);
    }

    // ---------------------------------------------------------------
    // Búsqueda del empleador
    // ---------------------------------------------------------------

    public function test_empleador_encuentra_trabajador_disponible_en_fecha()
    {
        $empleador = User::factory()->create(['role' => 'empleador']);
        $trabajador = User::factory()->create(['role' => 'trabajador']);

        $fecha = Carbon::tomorrow();
        FechaDisponible::create([
            'user_id' => $trabajador->id,
            'fecha' => $fecha,
            'disponible' => true,
        ]);

        $response = $this->actingAs($empleador)->get('/empleador/buscar?' . http_build_query([
            'fecha_inicio' => $fecha->format('Y-m-d'),
        ]));

        $response->assertStatus(200);
        $response->assertSee($trabajador->name);
    }

    public function test_empleador_no_encuentra_trabajador_sin_disponibilidad()
    {
        $empleador = User::factory()->create(['role' => 'empleador']);
        $trabajador = User::factory()->create(['role' => 'trabajador']);

        $fecha = Carbon::tomorrow();

        $response = $this->actingAs($empleador)->get('/empleador/buscar?' . http_build_query([
            'fecha_inicio' => $fecha->format('Y-m-d'),
        ]));

        $response->assertStatus(200);
        $response->assertDontSee($trabajador->name);
    }

    public function test_empleador_encuentra_trabajador_en_rango_de_fechas()
    {
        $empleador = User::factory()->create(['role' => 'empleador']);
        $trabajador = User::factory()->create(['role' => 'trabajador']);

        $inicio = Carbon::tomorrow();
        $fin = Carbon::tomorrow()->addDays(3);

        FechaDisponible::create([
            'user_id' => $trabajador->id,
            'fecha' => Carbon::tomorrow()->addDays(2), // cae dentro del rango
            'disponible' => true,
        ]);

        $response = $this->actingAs($empleador)->get('/empleador/buscar?' . http_build_query([
            'fecha_inicio' => $inicio->format('Y-m-d'),
            'fecha_fin' => $fin->format('Y-m-d'),
        ]));

        $response->assertStatus(200);
        $response->assertSee($trabajador->name);
    }

    public function test_usuario_dual_aparece_en_busqueda_de_empleador()
    {
        $empleador = User::factory()->create(['role' => 'empleador']);
        $dual = User::factory()->create(['role' => 'dual']);

        $fecha = Carbon::tomorrow();
        FechaDisponible::create([
            'user_id' => $dual->id,
            'fecha' => $fecha,
            'disponible' => true,
        ]);

        $response = $this->actingAs($empleador)->get('/empleador/buscar?' . http_build_query([
            'fecha_inicio' => $fecha->format('Y-m-d'),
        ]));

        $response->assertStatus(200);
        $response->assertSee($dual->name);
    }

    public function test_busqueda_falla_con_fecha_inicio_pasada()
    {
        $empleador = User::factory()->create(['role' => 'empleador']);

        $response = $this->actingAs($empleador)->get('/empleador/buscar?' . http_build_query([
            'fecha_inicio' => Carbon::yesterday()->format('Y-m-d'),
        ]));

        $response->assertSessionHasErrors('fecha_inicio');
    }

    public function test_busqueda_falla_con_fecha_fin_anterior_a_inicio()
    {
        $empleador = User::factory()->create(['role' => 'empleador']);

        $response = $this->actingAs($empleador)->get('/empleador/buscar?' . http_build_query([
            'fecha_inicio' => Carbon::tomorrow()->addDays(3)->format('Y-m-d'),
            'fecha_fin' => Carbon::tomorrow()->format('Y-m-d'),
        ]));

        $response->assertSessionHasErrors('fecha_fin');
    }
}