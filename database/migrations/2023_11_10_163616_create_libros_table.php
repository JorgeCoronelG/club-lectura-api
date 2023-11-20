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
            $table->string('clave');
            $table->string('isbn', 15);
            $table->string('titulo', 150);
            $table->tinyText('resenia')
                ->nullable();
            $table->smallInteger('num_paginas');
            $table->unsignedBigInteger('estado_fisico_id');
            $table->float('precio');
            $table->tinyInteger('edicion');
            $table->string('imagen');
            $table->tinyInteger('num_copia');
            $table->unsignedBigInteger('idioma_id');
            $table->unsignedBigInteger('estatus_id');
            $table->unsignedBigInteger('donacion_id');
            $table->unsignedBigInteger('genero_id');
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
