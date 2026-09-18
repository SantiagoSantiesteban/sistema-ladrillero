<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Indices en tabla users
        Schema::table('users', function (Blueprint $table) {
            $table->index('role', 'idx_users_role');
            $table->index('email', 'idx_users_email');
            $table->index('es_empleador', 'idx_users_empleador');
        });

        // Indices en tabla disponibilidades
        Schema::table('disponibilidades', function (Blueprint $table) {
            $table->index('user_id', 'idx_disp_user_id');
            $table->index(['lunes','martes','miercoles','jueves',
                          'viernes','sabado','domingo'], 
                          'idx_disp_dias');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('idx_users_role');
            $table->dropIndex('idx_users_email');
            $table->dropIndex('idx_users_empleador');
        });

        Schema::table('disponibilidades', function (Blueprint $table) {
            $table->dropIndex('idx_disp_user_id');
            $table->dropIndex('idx_disp_dias');
        });
    }
};