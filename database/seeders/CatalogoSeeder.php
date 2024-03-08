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
        $data = [];
        foreach (CatalogoEnum::values() as $key) {
            $data[] = [
                'id' => $key,
                'nombre' => CatalogoEnum::customName($key),
            ];
        }

        Catalogo::query()->insert($data);
    }
}
