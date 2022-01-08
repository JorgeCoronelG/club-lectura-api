<?php

namespace Database\Factories;

use App\Helpers\Validation;
use App\Models\Constants\UserFields;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        return [
            'name' => ($gender === 'male')
                ? $this->faker->name('male')
                : $this->faker->name('female'),
            'paternal_surname' => $this->faker->lastName(),
            'maternal_surname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'phone' => $this->faker->numerify('##########'),
            'birthday' =>$this->faker->date(Validation::FORMAT_DATE_YMD),
            'gender' => ($gender === 'male')
                ? UserFields::MALE_GENDER
                : UserFields::FEMALE_GENDER,
            'photo' => null,
            'status' => UserFields::ACTIVE_STATUS,
            'verified' => $verified = $this->faker->randomElement([UserFields::VERIFIED, UserFields::NOT_VERIFIED]),
            'verification_token' => User::generateVerificationToken(),
            'email_verified_at' => ($verified) ? now() : null
        ];
    }
}
