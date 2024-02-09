<?php

namespace Database\Seeders;

use App\Models\CatalogoOpcion;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\EstatusUsuarioEnum;
use App\Models\Enum\CatalogoOpciones\SexoUsuarioEnum;
use App\Models\Enum\CatalogoOpciones\TipoUsuarioEnum;
use App\Models\Enum\RolEnum;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class UsuarioSeederAdmin extends Seeder
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
        $hombreId = CatalogoOpcion::query()
            ->where('catalogo_id', CatalogoEnum::SEXO->value)
            ->where('opcion_id', SexoUsuarioEnum::HOMBRE)
            ->first()
            ->id;

        $usuario = Usuario::query()
            ->create([
                'nombre_completo' => 'Jorge Coronel González',
                'correo' => 'tprog.jorge.coronel@outlook.com',
                'contrasenia' => bcrypt('password'),
                'telefono' => '4423178052',
                'fecha_nacimiento' => '1998-08-29',
                'sexo_id' => $hombreId,
                'estatus_id' => $activoId,
                'rol_id' => RolEnum::ADMINISTRADOR->value,
                'tipo_id' => TipoUsuarioEnum::EXTERNO
            ]);

        $usuario->externo()->create(['usuario_id' => $usuario->id]);
    }
}
