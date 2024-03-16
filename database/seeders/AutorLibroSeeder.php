<?php

namespace Database\Seeders;

use App\Models\Autor;
use App\Models\Libro;
use Illuminate\Database\Seeder;
use Random\RandomException;

class AutorLibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        Libro::all()
            ->each(function (Libro $libro) {
                $autorIds = Autor::query()
                    ->inRandomOrder()
                    ->take(random_int(2,5))
                    ->get(['id'])
                    ->pluck('id')
                    ->toArray();

                info(json_encode($autorIds));

                $libro->autores()->attach($autorIds);
            });
    }
}
