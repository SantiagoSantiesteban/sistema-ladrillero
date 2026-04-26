<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Disponibilidad;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    public function test_trabajador_puede_guardar_disponibilidad()
    {
        $user = User::factory()->create(['role' => 'trabajador']);

        $response = $this->actingAs($user)->post('/trabajador/disponibilidad', [
            'lunes' => '1',
            'miercoles' => '1',
            'viernes' => '1',
            'descripcion' => 'Disponible para turnos largos',
        ]);

        $response->assertRedirect('/trabajador');
        $this->assertDatabaseHas('disponibilidades', [
            'user_id' => $user->id,
            'lunes' => 1,
            'miercoles' => 1,
            'viernes' => 1,
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
}