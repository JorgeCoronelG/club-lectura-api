<?php

namespace Database\Seeders;

use App\Models\Catalogo;
use App\Models\Enum\CatalogoEnum;
use Illuminate\Database\Seeder;

class CatalogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Catalogo::query()
            ->insert([
                $this->catalogoData(CatalogoEnum::ESTATUS_USUARIO->value,'Estatus del usuario'),
                $this->catalogoData(CatalogoEnum::SEXO->value,'Sexo del usuario'),
                $this->catalogoData(CatalogoEnum::TIPO_ESCOLAR->value,'Tipo de persona escolar'),
                $this->catalogoData(CatalogoEnum::TURNO_ALUMNO->value,'Turno escolar'),
                $this->catalogoData(CatalogoEnum::TIPO_USUARIO->value,'Tipo de usuario'),
            ]);
    }

    private function catalogoData(int $id, string $nombre): array
    {
        return [
            'id' => $id,
            'nombre' => $nombre
        ];
    }
}
