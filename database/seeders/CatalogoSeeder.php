<?php

namespace Database\Seeders;

use App\Models\Catalogo;
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
                $this->catalogoData('Estatus del usuario'),
                $this->catalogoData('Sexo del usuario'),
                $this->catalogoData('Tipo de persona escolar'),
                $this->catalogoData('Turno escolar'),
                $this->catalogoData('Tipo de usuario'),
            ]);
    }

    private function catalogoData(string $nombre): array
    {
        return ['nombre' => $nombre];
    }
}
