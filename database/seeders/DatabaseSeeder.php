<?php

namespace Database\Seeders;

use App\Core\Enum\Path;
use App\Helpers\File;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (env('APP_ENV') === 'local') {
            $this->deleteImageBooks();
        }

        $this->call(CatalogoSeeder::class);
        $this->call(CatalogoOpcionSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(UsuarioSeederAdmin::class);
        $this->call(UsuarioCapturistaSeeder::class);
        $this->call(ExternoSeeder::class);
        $this->call(EscolarSeeder::class);
        $this->call(AlumnoSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(MenuUsuarioSeeder::class);
        $this->call(AutorSeeder::class);
        $this->call(GeneroLiterarioSeeder::class);
        $this->call(LibroSeeder::class);
        $this->call(AutorLibroSeeder::class);
        $this->call(PrestamoSeeder::class);
    }

    private function deleteImageBooks(): void
    {
        $files = glob(File::storagePath(Path::BOOK_IMAGES->value).'/*');
        foreach ($files as $file) {
            if (is_file($file) && !str_contains($file, 'no-image')) {
                unlink($file);
            }
        }
    }
}
