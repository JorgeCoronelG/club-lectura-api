<?php

namespace Database\Seeders;

use App\Models\CatalogoOpcion;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\EstatusUsuarioEnum;
use App\Models\Enum\CatalogoOpciones\SexoUsuarioEnum;
use App\Models\Enum\CatalogoOpciones\TipoUsuarioEnum;
use App\Models\Enum\RolEnum;
use App\Models\Externo;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class ExternoSeeder extends Seeder
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

        Usuario::factory(5)
            ->create([
                'sexo_id' => $sexoId,
                'estatus_id' => $activoId,
                'rol_id' => RolEnum::LECTOR->value,
                'tipo_id' => TipoUsuarioEnum::EXTERNO
            ])
            ->each(function (Usuario $usuario) {
                $usuario->externo()->create([
                    'usuario_id' => $usuario->id
                ]);
            });
    }
}
