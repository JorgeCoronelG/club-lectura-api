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
        Schema::create('multas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('costo');
            $table->unsignedBigInteger('estatus_id');
            $table->unsignedBigInteger('prestamo_id');
            $table->timestamp('creado_en')
                ->useCurrent();
            $table->timestamp('actualizado_en')
                ->nullable()
                ->useCurrentOnUpdate();

            $table->foreign('estatus_id')
                ->references('id')
                ->on('catalogo_opciones');
            $table->foreign('prestamo_id')
                ->references('id')
                ->on('prestamos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multas');
    }
};
