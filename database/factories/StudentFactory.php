<?php

namespace Database\Factories;

use App\Models\Enums\TurnStudent;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'group' => $this->faker->word(),
            'turn' => $this->faker->randomElement(TurnStudent::getAllTurns())
        ];
    }
}
