<?php

namespace Database\Seeders;

use App\Models\CatalogoOpcion;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\EstatusUsuarioEnum;
use App\Models\Enum\CatalogoOpciones\SexoUsuarioEnum;
use App\Models\Enum\CatalogoOpciones\TipoEscolarEnum;
use App\Models\Enum\CatalogoOpciones\TurnoAlumnoEnum;
use Illuminate\Database\Seeder;

class CatalogoOpcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CatalogoOpcion::query()
            ->insert($this->obtenerDataOpciones(EstatusUsuarioEnum::array(), CatalogoEnum::ESTATUS_USUARIO->value));
        CatalogoOpcion::query()
            ->insert($this->obtenerDataOpciones(SexoUsuarioEnum::array(), CatalogoEnum::SEXO->value));
        CatalogoOpcion::query()
            ->insert($this->obtenerDataOpciones(TipoEscolarEnum::array(), CatalogoEnum::TIPO_ESCOLAR->value));
        CatalogoOpcion::query()
            ->insert($this->obtenerDataOpciones(TurnoAlumnoEnum::array(), CatalogoEnum::TURNO_ALUMNO->value));
    }

    private function obtenerDataOpciones(array $enum, int $catalogoId): array
    {
        $data = [];

        foreach ($enum as $key => $value) {
            $data[] = [
                'opcion_id' => $value,
                'catalogo_id' => $catalogoId,
                'valor' => ucwords(strtolower($key))
            ];
        }

        return $data;
    }
}
