<?php

namespace Database\Factories;

use App\Helpers\Enum\Gender;
use App\Helpers\Validation;
use App\Models\Enums\StatusUser;
use App\Models\FormFields\UserFields;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * @throws \Exception
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        return [
            'complete_name' => $this->faker->name($gender).' '.$this->faker->lastName(),
            'email' => $this->faker->unique()->freeEmail(),
            'password' => bcrypt('password'),
            'phone' => $this->faker->numerify('##########'),
            'birthday' =>$this->faker->date(Validation::FORMAT_DATE_YMD),
            'gender' => ($gender === 'male')
                ? Gender::Male->value
                : Gender::Female->value,
            'photo' => /*(random_int(0,1))
                ? $this->faker->image(File::getFilePublicPath(Path::USER_IMAGES->value), 500, 500, fullPath: false)
                :*/ UserFields::PHOTO_DEFAULT,
            'status' => StatusUser::Active->value,
            'verified' => $verified = $this->faker->randomElement([UserFields::VERIFIED, UserFields::NOT_VERIFIED]),
            'verification_token' => User::generateVerificationToken(),
            'email_verified_at' => ($verified) ? now() : null
        ];
    }
}
