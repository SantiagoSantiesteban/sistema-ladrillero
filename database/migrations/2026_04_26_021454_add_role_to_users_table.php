<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('trabajador');
            $table->boolean('es_empleador')->default(false);
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'es_empleador', 'telefono', 'direccion']);
        });
    }
};