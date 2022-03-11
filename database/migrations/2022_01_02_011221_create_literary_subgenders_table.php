<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiterarySubgendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('literary_subgenders', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 100);
            $table->unsignedSmallInteger('literary_gender_id');
            $table->foreign('literary_gender_id')
                ->references('id')
                ->on('literary_genders')
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('literary_subgenders');
    }
}
