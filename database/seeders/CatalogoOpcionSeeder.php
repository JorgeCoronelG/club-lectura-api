<?php

namespace Database\Seeders;

use App\Models\CatalogoOpcion;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\CarrerasEducativasEnum;
use App\Models\Enum\CatalogoOpciones\EstatusUsuarioEnum;
use App\Models\Enum\CatalogoOpciones\SexoUsuarioEnum;
use App\Models\Enum\CatalogoOpciones\TipoEscolarEnum;
use App\Models\Enum\CatalogoOpciones\TipoUsuarioEnum;
use App\Models\Enum\CatalogoOpciones\TurnoAlumnoEnum;
use Illuminate\Database\Seeder;

class CatalogoOpcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->insertCatalogo(
            EstatusUsuarioEnum::values(), CatalogoEnum::ESTATUS_USUARIO->value, fn ($case) => EstatusUsuarioEnum::customName($case)
        );
        $this->insertCatalogo(
            SexoUsuarioEnum::values(), CatalogoEnum::SEXO->value, fn ($case) => SexoUsuarioEnum::customName($case)
        );
        $this->insertCatalogo(
            TipoEscolarEnum::values(), CatalogoEnum::TIPO_ESCOLAR->value, fn ($case) => TipoEscolarEnum::customName($case)
        );
        $this->insertCatalogo(
            TurnoAlumnoEnum::values(), CatalogoEnum::TURNO_ALUMNO->value, fn ($case) => TurnoAlumnoEnum::customName($case)
        );
        $this->insertCatalogo(
            TipoUsuarioEnum::values(), CatalogoEnum::TIPO_USUARIO->value, fn ($case) => TipoUsuarioEnum::customName($case)
        );
        $this->insertCatalogo(
            CarrerasEducativasEnum::values(), CatalogoEnum::CARRERAS_EDUCATIVAS->value, fn ($case) => CarrerasEducativasEnum::customName($case)
        );
    }

    private function insertCatalogo(array $enum, int $catalogoId, $customNameFn): void
    {
        $data = [];

        foreach ($enum as $value) {
            $data[] = [
                'opcion_id' => $value,
                'catalogo_id' => $catalogoId,
                'valor' => $customNameFn($value)
            ];
        }

        CatalogoOpcion::query()->insert($data);
    }
}
