<?php

namespace Database\Factories;

use App\Core\Enum\Path;
use App\Helpers\File;
use App\Models\Libro;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Libro>
 */
class LibroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'isbn' => $this->faker->isbn13(),
            'titulo' => $this->faker->sentence(4),
            'resenia' => $this->faker->sentence(),
            'num_paginas' => random_int(100, 1000),
            'precio' => $this->faker->randomFloat(2, max: 2500),
            'edicion' => random_int(1, 15),
            'imagen' => Libro::IMAGE_DEFAULT,
            'num_copia' => random_int(1, 5)
        ];
    }
}
