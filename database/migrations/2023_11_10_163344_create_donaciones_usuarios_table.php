<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donaciones_usuarios', function (Blueprint $table) {
            $table->unsignedBigInteger('donacion_id');
            $table->unsignedBigInteger('usuario_id');
            $table->tinyText('referencia');

            $table->foreign('donacion_id')
                ->references('id')
                ->on('donaciones');
            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donaciones_usuarios');
    }
};
