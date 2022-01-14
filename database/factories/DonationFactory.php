<?php

namespace Database\Factories;

use Carbon\Carbon;
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
            'donation_date' => Carbon::parse($this->faker->dateTimeBetween('-60 days', '-30 days'))
                ->toDateString()
        ];
    }
}
