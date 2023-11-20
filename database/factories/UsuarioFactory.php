<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_completo' => fake()->name(),
            'correo' => fake()->safeEmail(),
            'contrasenia' => bcrypt('password'),
            'telefono' => fake()->numerify('##########'),
            'fecha_nacimiento' => fake()->dateTimeBetween('-50 years', '-15 years'),
        ];
    }
}
