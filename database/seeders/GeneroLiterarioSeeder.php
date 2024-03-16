<?php

namespace Database\Seeders;

use App\Models\Genero;
use Illuminate\Database\Seeder;

class GeneroLiterarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nombre' => 'Narrativo'],
            ['nombre' => 'Lírico'],
            ['nombre' => 'Dramático'],
            ['nombre' => 'Didáctico']
        ];

        Genero::query()->insert($data);
    }
}
