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
        Schema::create('libros_prestamos', function (Blueprint $table) {
            $table->unsignedBigInteger('prestamo_id');
            $table->unsignedBigInteger('libro_id');

            $table->foreign('prestamo_id')
                ->references('id')
                ->on('prestamos');
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
        Schema::dropIfExists('libros_prestamos');
    }
};
