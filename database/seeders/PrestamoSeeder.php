<?php

namespace Database\Seeders;

use App\Models\CatalogoOpcion;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\EstatusLibroEnum;
use App\Models\Enum\CatalogoOpciones\EstatusPrestamoEnum;
use App\Models\Enum\RolEnum;
use App\Models\Genero;
use App\Models\Libro;
use App\Models\LibroPrestamo;
use App\Models\Prestamo;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrestamoSeeder extends Seeder
{
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
            ->where('opcion_id', EstatusLibroEnum::PRESTADO->value)
            ->first()
            ->id;
        $generoId = Genero::query()
            ->inRandomOrder()
            ->first()
            ->id;
        $estatusPrestamo = CatalogoOpcion::query()
            ->where('catalogo_id', CatalogoEnum::ESTATUS_PRESTAMO->value)
            ->where('opcion_id', EstatusPrestamoEnum::PRESTAMO->value)
            ->first()
            ->id;

        Libro::factory(3)
            ->create([
                'estado_fisico_id' => $estadoFisicoId,
                'idioma_id' => $idiomaId,
                'estatus_id' => $estatusId,
                'genero_id' => $generoId
            ])
            ->each(function (Libro $libro) use ($estatusPrestamo) {
                $now = now();
                $usuarioId = Usuario::query()
                    ->where('rol_id', RolEnum::LECTOR->value)
                    ->inRandomOrder()
                    ->first()
                    ->id;

                $prestamo = Prestamo::query()->create([
                    'fecha_prestamo' => $now,
                    'fecha_entrega' => $now->clone()->addDays(14),
                    'usuario_id' => $usuarioId,
                    'estatus_id' => $estatusPrestamo
                ]);
                LibroPrestamo::query()->create([
                    'libro_id' => $libro->id,
                    'prestamo_id' => $prestamo->id
                ]);
            });
    }
}
