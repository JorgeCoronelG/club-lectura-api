<?php

namespace Database\Seeders;

use App\Models\CatalogoOpcion;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\CarrerasEducativasEnum;
use App\Models\Enum\CatalogoOpciones\EstadoFisicoLibroEnum;
use App\Models\Enum\CatalogoOpciones\EstatusLibroEnum;
use App\Models\Enum\CatalogoOpciones\EstatusMultaEnum;
use App\Models\Enum\CatalogoOpciones\EstatusPrestamoEnum;
use App\Models\Enum\CatalogoOpciones\EstatusUsuarioEnum;
use App\Models\Enum\CatalogoOpciones\IdiomaLibroEnum;
use App\Models\Enum\CatalogoOpciones\CostoMultaEnum;
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
            EstatusUsuarioEnum::values(),
            CatalogoEnum::ESTATUS_USUARIO->value,
            fn (int $case) => EstatusUsuarioEnum::customName($case),
            fn (int $case) => EstatusUsuarioEnum::classCss($case)
        );
        $this->insertCatalogo(
            SexoUsuarioEnum::values(),
            CatalogoEnum::SEXO->value,
            fn (int $case) => SexoUsuarioEnum::customName($case),
            fn (int $case) => SexoUsuarioEnum::classCss($case)
        );
        $this->insertCatalogo(
            TipoEscolarEnum::values(), CatalogoEnum::TIPO_ESCOLAR->value, fn (int $case) => TipoEscolarEnum::customName($case)
        );
        $this->insertCatalogo(
            TurnoAlumnoEnum::values(), CatalogoEnum::TURNO_ALUMNO->value, fn (int $case) => TurnoAlumnoEnum::customName($case)
        );
        $this->insertCatalogo(
            TipoUsuarioEnum::values(), CatalogoEnum::TIPO_USUARIO->value, fn (int $case) => TipoUsuarioEnum::customName($case)
        );
        $this->insertCatalogo(
            CarrerasEducativasEnum::values(), CatalogoEnum::CARRERAS_EDUCATIVAS->value, fn (int $case) => CarrerasEducativasEnum::customName($case)
        );
        $this->insertCatalogo(
            EstadoFisicoLibroEnum::values(),
            CatalogoEnum::ESTADO_FISICO_LIBRO->value,
            fn (int $case) => EstadoFisicoLibroEnum::customName($case),
            fn (int $case) => EstadoFisicoLibroEnum::classCss($case)
        );
        $this->insertCatalogo(
            IdiomaLibroEnum::values(), CatalogoEnum::IDIOMA->value, fn (int $case) => IdiomaLibroEnum::customName($case)
        );
        $this->insertCatalogo(
            EstatusLibroEnum::values(),
            CatalogoEnum::ESTATUS_LIBRO->value,
            fn (int $case) => EstatusLibroEnum::customName($case),
            fn (int $case) => EstatusLibroEnum::classCss($case)
        );
        $this->insertCatalogo(
            EstatusPrestamoEnum::values(),
            CatalogoEnum::ESTATUS_PRESTAMO->value,
            fn (int $case) => EstatusPrestamoEnum::customName($case),
            fn (int $case) => EstatusPrestamoEnum::classCss($case)
        );
        $this->insertCatalogo(
            EstatusMultaEnum::values(),
            CatalogoEnum::ESTATUS_MULTA->value,
            fn (int $case) => EstatusMultaEnum::customName($case),
            fn (int $case) => EstatusMultaEnum::classCss($case)
        );
        $this->insertCatalogo(
            CostoMultaEnum::values(),
            CatalogoEnum::COSTO_MULTA_POR_DIA->value,
            fn (int $case) => CostoMultaEnum::customName($case),
        );
    }

    private function insertCatalogo(array $enum, int $catalogoId, callable $customNameFn, callable $classCssFn = null): void
    {
        $data = [];

        foreach ($enum as $value) {
            $data[] = [
                'opcion_id' => $value,
                'catalogo_id' => $catalogoId,
                'valor' => $customNameFn($value),
                'clase_css' => is_null($classCssFn) ? null : $classCssFn($value)
            ];
        }

        CatalogoOpcion::query()->insert($data);
    }
}
