<?php

namespace Database\Factories;

use App\Helpers\Validation;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'donation_date' => ($this->faker->dateTimeBetween('-60 days', '-30 days'))
                ->format(Validation::FORMAT_DATE_YMD)
        ];
    }
}
