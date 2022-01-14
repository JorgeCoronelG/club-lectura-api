<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $fakeData = array();
        $dateLoan = Carbon::parse($this->faker->dateTimeBetween('-25 days'));
        $fakeData['loan'] = $dateLoan->toDateString();

        $dateLoan->addDays(15);
        $fakeData['approximate_delivery'] = $dateLoan->toDateString();

        $now = now();
        $fakeData['actual_delivery'] = null;
        if ($dateLoan->toDateString() === $now->toDateString()) {
            $fakeData['actual_delivery'] = $dateLoan->toDateString();
        }

        return $fakeData;
    }
}
