<?php

namespace Database\Factories;

use App\Helpers\Validation;
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
        $dateLoan = $this->faker->dateTimeBetween('-15 days');
        return [
            'loan' => $dateLoan->format(Validation::FORMAT_DATE_YMD),
            'approximate_delivery' => date_add($dateLoan, date_interval_create_from_date_string('15 days'))
                ->format(Validation::FORMAT_DATE_YMD)
        ];
    }
}
