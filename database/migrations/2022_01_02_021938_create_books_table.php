<?php

use App\Models\Enums\IsbnBook;
use App\Models\FormFields\BookFields;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('code', BookFields::CODE_LENGTH)
                ->nullable();
            $table->string('isbn', IsbnBook::ISBN_NEW_LENGTH->value);
            $table->string('title', BookFields::TITLE_MAX_LENGTH);
            $table->text('review')
                ->nullable();
            $table->smallInteger('no_pages');
            $table->tinyInteger('condition');
            $table->float('price', BookFields::PRICE_TOTAL_DIGITS, BookFields::PRICE_TOTAL_DECIMAL);
            $table->tinyInteger('edition');
            $table->string('image', BookFields::IMAGE_LENGTH)
                ->nullable();
            $table->smallInteger('copy');
            $table->tinyInteger('language');
            $table->tinyInteger('status');
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
