<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FormFields\UserFields;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('complete_name', UserFields::COMPLETE_NAME_MAX_LENGTH);
            $table->string('email', UserFields::EMAIL_MAX_LENGTH)
                ->unique()
                ->index();
            $table->string('password');
            $table->string('phone', UserFields::PHONE_LENGTH);
            $table->date('birthday');
            $table->tinyInteger('gender');
            $table->string('photo', UserFields::PHOTO_LENGTH);
            $table->tinyInteger('status');
            $table->boolean('verified')
                ->default(UserFields::NOT_VERIFIED);
            $table->string('verification_token', UserFields::VERIFICATION_TOKEN_LENGTH)
                ->nullable()
                ->unique();
            $table->timestamp('email_verified_at')
                ->nullable()
                ->default(null);
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
        Schema::dropIfExists('users');
    }
}
