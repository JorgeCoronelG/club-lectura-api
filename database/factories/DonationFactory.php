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
            'donation_date' => ($this->faker->dateTimeBetween($start_date = '-30 days', $endDate = 'now'))
                ->format(Validation::FORMAT_DATE_YMD)
        ];
    }
}
