<?php

namespace Database\Seeders;

use App\Models\CatalogoOpcion;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\EstatusUsuarioEnum;
use App\Models\Enum\CatalogoOpciones\TipoUsuarioEnum;
use App\Models\Enum\RolEnum;
use App\Models\Escolar;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class EscolarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activoId = CatalogoOpcion::query()
            ->where('catalogo_id', CatalogoEnum::ESTATUS_USUARIO->value)
            ->where('opcion_id', EstatusUsuarioEnum::ACTIVO->value)
            ->first()
            ->id;
        $sexoId = CatalogoOpcion::query()
            ->where('catalogo_id', CatalogoEnum::SEXO->value)
            ->inRandomOrder()
            ->first()
            ->id;
        $tipoId = CatalogoOpcion::query()
            ->where('catalogo_id', CatalogoEnum::TIPO_USUARIO->value)
            ->where('opcion_id', TipoUsuarioEnum::ESCOLAR->value)
            ->first()
            ->id;
        $tipoEscolarId = CatalogoOpcion::query()
            ->where('catalogo_id', CatalogoEnum::TIPO_ESCOLAR->value)
            ->inRandomOrder()
            ->first()
            ->id;

        Usuario::factory(5)
            ->create([
                'sexo_id' => $sexoId,
                'estatus_id' => $activoId,
                'rol_id' => RolEnum::LECTOR->value,
                'tipo_id' => $tipoId
            ])
            ->each(function (Usuario $usuario) use ($tipoEscolarId) {
                Escolar::factory()
                    ->create([
                        'usuario_id' => $usuario->id,
                        'tipo_id' => $tipoEscolarId
                    ]);
            });
    }
}
