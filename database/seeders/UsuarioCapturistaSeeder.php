<?php

namespace Database\Seeders;

use App\Models\CatalogoOpcion;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\EstatusUsuarioEnum;
use App\Models\Enum\CatalogoOpciones\TipoUsuarioEnum;
use App\Models\Enum\RolEnum;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class UsuarioCapturistaSeeder extends Seeder
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

        Usuario::factory(2)->create([
            'sexo_id' => $sexoId,
            'estatus_id' => $activoId,
            'rol_id' => RolEnum::CAPTURISTA->value,
            'tipo_id' => TipoUsuarioEnum::ALUMNO
        ]);
    }
}
