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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_prestamo');
            $table->date('fecha_entrega');
            $table->date('fecha_real_entrega')
                ->nullable();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('estatus_id');
            $table->timestamp('creado_en')
                ->useCurrent();
            $table->timestamp('actualizado_en')
                ->nullable()
                ->useCurrentOnUpdate();

            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuarios');
            $table->foreign('estatus_id')
                ->references('id')
                ->on('catalogo_opciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
