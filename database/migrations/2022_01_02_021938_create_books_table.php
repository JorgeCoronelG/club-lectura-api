<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Constants\BookFields;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', BookFields::TITLE_MAX_LENGTH);
            $table->text('review')
                ->nullable();
            $table->smallInteger('no_pages');
            $table->enum('condition', BookFields::ALL_CONDITIONS);
            $table->float('price', BookFields::PRICE_TOTAL_DIGITS, BookFields::PRICE_TOTAL_DECIMAL);
            $table->tinyInteger('edition');
            $table->string('image', BookFields::IMAGE_LENGTH);
            $table->enum('status', BookFields::ALL_STATUS);
            $table->foreignId('donation_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->unsignedSmallInteger('literary_subgender_id');
            $table->foreign('literary_subgender_id')
                ->references('id')
                ->on('literary_subgenders')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
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
        Schema::dropIfExists('books');
    }
}
