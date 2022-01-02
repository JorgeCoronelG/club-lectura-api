<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Constants\BookLoanFields;

class CreateBookLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_loan', function (Blueprint $table) {
            $table->id();
            $table->float('cost', BookLoanFields::COST_TOTAL_DIGITS, BookLoanFields::COST_TOTAL_DECIMAL);
            $table->enum('status', BookLoanFields::ALL_STATUS);
            $table->foreignId('loan_id')
                ->constrained()
                ->cascadeOnDelete()
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
        Schema::dropIfExists('book_loan');
    }
}
