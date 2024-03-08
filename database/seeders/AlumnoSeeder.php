<?php

namespace Database\Seeders;

use App\Models\Alumno;
use App\Models\CatalogoOpcion;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\EstatusUsuarioEnum;
use App\Models\Enum\CatalogoOpciones\TipoUsuarioEnum;
use App\Models\Enum\RolEnum;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class AlumnoSeeder extends Seeder
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
        $turnoId = CatalogoOpcion::query()
            ->where('catalogo_id', CatalogoEnum::TURNO_ALUMNO->value)
            ->inRandomOrder()
            ->first()
            ->id;
        $tipoId = CatalogoOpcion::query()
            ->where('catalogo_id', CatalogoEnum::TIPO_USUARIO->value)
            ->where('opcion_id', TipoUsuarioEnum::ALUMNO->value)
            ->first()
            ->id;
        $carreraId = CatalogoOpcion::query()
            ->where('catalogo_id', CatalogoEnum::CARRERAS_EDUCATIVAS->value)
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
            ->each(function (Usuario $usuario) use ($turnoId, $carreraId) {
                Alumno::factory()
                    ->create([
                        'usuario_id' => $usuario->id,
                        'turno_id' => $turnoId,
                        'carrera_id' => $carreraId
                    ]);
            });
    }
}
