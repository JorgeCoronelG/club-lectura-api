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
        Schema::create('submenu_usuarios', function (Blueprint $table) {
            $table->unsignedBigInteger('submenu_id');
            $table->unsignedBigInteger('usuario_id');

            $table->foreign('submenu_id')
                ->references('id')
                ->on('submenus');
            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submenu_usuarios');
    }
};
