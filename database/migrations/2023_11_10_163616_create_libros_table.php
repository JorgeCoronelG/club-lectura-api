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
        Schema::create('libros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('clave')
                ->nullable();
            $table->string('isbn', 18);
            $table->string('titulo', 150);
            $table->text('resenia')
                ->nullable();
            $table->smallInteger('num_paginas');
            $table->float('precio');
            $table->tinyInteger('edicion');
            $table->string('imagen');
            $table->tinyInteger('num_copia');
            $table->unsignedBigInteger('estado_fisico_id');
            $table->unsignedBigInteger('idioma_id');
            $table->unsignedBigInteger('estatus_id');
            $table->unsignedBigInteger('donacion_id')
                ->nullable();
            $table->unsignedBigInteger('genero_id');
            $table->softDeletes('eliminado_en');
            $table->timestamp('creado_en')
                ->useCurrent();
            $table->timestamp('actualizado_en')
                ->nullable()
                ->useCurrentOnUpdate();

            $table->foreign('estado_fisico_id')
                ->references('id')
                ->on('catalogo_opciones');
            $table->foreign('idioma_id')
                ->references('id')
                ->on('catalogo_opciones');
            $table->foreign('estatus_id')
                ->references('id')
                ->on('catalogo_opciones');
            $table->foreign('donacion_id')
                ->references('id')
                ->on('donaciones');
            $table->foreign('genero_id')
                ->references('id')
                ->on('generos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
