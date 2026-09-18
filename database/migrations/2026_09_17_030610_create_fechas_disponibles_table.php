<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fechas_disponibles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('fecha');
            $table->boolean('disponible')->default(true);
            $table->text('nota')->nullable();
            $table->timestamps();

            // Un trabajador solo puede tener un registro por fecha
            $table->unique(['user_id', 'fecha']);

            // Indice para busqueda rapida por fecha
            $table->index('fecha');
            $table->index(['fecha', 'disponible']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fechas_disponibles');
    }
};