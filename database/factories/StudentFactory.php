<?php

namespace Database\Factories;

use App\Models\Constants\StudentFields;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'group' => $this->faker->word(),
            'turn' => $this->faker->randomElement([StudentFields::MORNING_TURN, StudentFields::AFTERNOON_TURN])
        ];
    }
}
