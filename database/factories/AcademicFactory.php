<?php

namespace Database\Factories;

use App\Models\Constants\AcademicFields;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AcademicFactory extends Factory
{
    public function definition(): array
    {
        return [
            'registration' => Str::random(10),
            'type' => $this->faker->randomElement(AcademicFields::ALL_TYPES)
        ];
    }
}
