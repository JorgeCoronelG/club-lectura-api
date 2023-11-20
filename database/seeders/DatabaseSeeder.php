<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CatalogoSeeder::class);
        $this->call(CatalogoOpcionSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(UsuarioSeederAdmin::class);
        $this->call(UsuarioCapturistaSeeder::class);
        $this->call(ExternoSeeder::class);
        $this->call(EscolarSeeder::class);
        $this->call(AlumnoSeeder::class);
    }
}
