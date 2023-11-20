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
        Schema::create('autores_libros', function (Blueprint $table) {
            $table->unsignedBigInteger('autor_id');
            $table->unsignedBigInteger('libro_id');

            $table->foreign('autor_id')
                ->references('id')
                ->on('autores');
            $table->foreign('libro_id')
                ->references('id')
                ->on('libros');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autores_libros');
    }
};
