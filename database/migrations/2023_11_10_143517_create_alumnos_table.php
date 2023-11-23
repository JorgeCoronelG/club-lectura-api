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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_id');
            $table->string('grupo', 15);
            $table->unsignedBigInteger('turno_id');

            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuarios')
                ->cascadeOnDelete();
            $table->foreign('turno_id')
                ->references('id')
                ->on('catalogo_opciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
