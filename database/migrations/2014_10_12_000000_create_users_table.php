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
            $table->string('code', UserFields::CODE_LENGTH)
                ->nullable();
            $table->string('name', UserFields::NAME_MAX_LENGTH);
            $table->string('paternal_surname', UserFields::LAST_NAME_MAX_LENGTH);
            $table->string('maternal_surname', UserFields::LAST_NAME_MAX_LENGTH);
            $table->string('email', UserFields::EMAIL_MAX_LENGTH)
                ->unique()
                ->index();
            $table->string('password');
            $table->string('phone', UserFields::PHONE_LENGTH);
            $table->date('birthday');
            $table->tinyInteger('gender');
            $table->string('photo', UserFields::PHOTO_LENGTH)
                ->nullable();
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
