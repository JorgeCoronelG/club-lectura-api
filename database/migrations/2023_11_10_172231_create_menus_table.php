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
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('path_ruta');
            $table->string('etiqueta', 120);
            $table->string('icono', 100);
            $table->tinyInteger('orden');
            $table->boolean('estatus')->default(true);
            $table->unsignedTinyInteger('rol_id');

            $table->foreign('rol_id')
                ->references('id')
                ->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
