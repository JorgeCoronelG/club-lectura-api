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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_completo');
            $table->string('correo', 150)
                ->unique();
            $table->string('contrasenia');
            $table->string('telefono', 10);
            $table->date('fecha_nacimiento');
            $table->unsignedBigInteger('sexo_id');
            $table->unsignedBigInteger('estatus_id');
            $table->unsignedTinyInteger('rol_id');
            $table->unsignedBigInteger('tipo_id');
            $table->softDeletes('eliminado_en');
            $table->timestamp('creado_en')
                ->useCurrent();
            $table->timestamp('actualizado_en')
                ->nullable()
                ->useCurrentOnUpdate();

            $table->foreign('sexo_id')
                ->references('id')
                ->on('catalogo_opciones');
            $table->foreign('estatus_id')
                ->references('id')
                ->on('catalogo_opciones');
            $table->foreign('rol_id')
                ->references('id')
                ->on('roles');
            $table->foreign('tipo_id')
                ->references('id')
                ->on('catalogo_opciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
