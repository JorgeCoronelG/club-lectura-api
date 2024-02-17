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
        Schema::create('catalogo_opciones', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->bigInteger('opcion_id');
            $table->unsignedBigInteger('catalogo_id');
            $table->string('valor', 150);
            $table->boolean('estatus')
                ->default(true);
            $table->timestamp('creado_en')
                ->useCurrent();

            $table->primary('id');
            $table->foreign('catalogo_id')
                ->references('id')
                ->on('catalogos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogo_opciones');
    }
};
