<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumno>
 */
class AlumnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $grupos = [
            '1-TPROG-AM',
            '1-TPROG-BM',
            '1-TPROG-AV',
            '1-TPROG-BV',
        ];

        return [
            'grupo' => $grupos[rand(0,3)]
        ];
    }
}
