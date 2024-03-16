<?php

namespace Database\Seeders;

use App\Models\CatalogoOpcion;
use App\Models\Enum\CatalogoEnum;
use App\Models\Genero;
use App\Models\Libro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibroSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estadoFisicoId = CatalogoOpcion::query()
            ->where('catalogo_id', CatalogoEnum::ESTADO_FISICO_LIBRO->value)
            ->inRandomOrder()
            ->first()
            ->id;
        $idiomaId = CatalogoOpcion::query()
            ->where('catalogo_id', CatalogoEnum::IDIOMA->value)
            ->inRandomOrder()
            ->first()
            ->id;
        $estatusId = CatalogoOpcion::query()
            ->where('catalogo_id', CatalogoEnum::ESTATUS_LIBRO->value)
            ->inRandomOrder()
            ->first()
            ->id;
        $generoId = Genero::query()
            ->inRandomOrder()
            ->first()
            ->id;

        Libro::factory(10)
            ->create([
                'estado_fisico_id' => $estadoFisicoId,
                'idioma_id' => $idiomaId,
                'estatus_id' => $estatusId,
                'genero_id' => $generoId
            ])
            ->each(function (Libro $libro) {
                $libro->clave = "L-$libro->id";
                $libro->save();
            });
    }
}
