<?php

namespace Database\Seeders;

use App\Models\CatalogoOpcion;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\CostoMultaEnum;
use App\Models\Enum\CatalogoOpciones\EstatusLibroEnum;
use App\Models\Enum\CatalogoOpciones\EstatusMultaEnum;
use App\Models\Enum\CatalogoOpciones\EstatusPrestamoEnum;
use App\Models\Enum\RolEnum;
use App\Models\Genero;
use App\Models\Libro;
use App\Models\LibroPrestamo;
use App\Models\Multa;
use App\Models\Prestamo;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class MultaSeeder extends Seeder
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
            ->where('opcion_id', EstatusLibroEnum::PRESTAMO->value)
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
        $estatusMulta = CatalogoOpcion::query()
            ->where('catalogo_id', CatalogoEnum::ESTATUS_MULTA->value)
            ->where('opcion_id', EstatusMultaEnum::PENDIENTE->value)
            ->first()
            ->id;
        $costoMulta = intval(
            CatalogoOpcion::query()
                ->where('catalogo_id', CatalogoEnum::COSTO_MULTA_POR_DIA->value)
                ->where('opcion_id', CostoMultaEnum::POR_DIA->value)
                ->first()
                ->valor
        );

        Libro::factory(2)
            ->create([
                'estado_fisico_id' => $estadoFisicoId,
                'idioma_id' => $idiomaId,
                'estatus_id' => $estatusId,
                'genero_id' => $generoId
            ])
            ->each(function (Libro $libro) use ($estatusPrestamo, $estatusMulta, $costoMulta) {
                $dateLoan = now()->subWeeks(3);
                $dateDelivered = $dateLoan->clone()->addWeeks(2);
                $daysDiff = $dateDelivered->diffInDays(now());

                $usuarioId = Usuario::query()
                    ->where('rol_id', RolEnum::LECTOR->value)
                    ->inRandomOrder()
                    ->first()
                    ->id;

                $prestamo = Prestamo::query()->create([
                    'fecha_prestamo' => $dateLoan,
                    'fecha_entrega' => $dateDelivered,
                    'usuario_id' => $usuarioId,
                    'estatus_id' => $estatusPrestamo
                ]);
                LibroPrestamo::query()->create([
                    'libro_id' => $libro->id,
                    'prestamo_id' => $prestamo->id
                ]);
                Multa::query()->create([
                    'costo' => $daysDiff * $costoMulta,
                    'estatus_id' => $estatusMulta,
                    'prestamo_id' => $prestamo->id
                ]);
            });
    }
}
