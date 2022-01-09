<?php

namespace Database\Seeders;

use App\Repositories\LiterarySubgenderRepository;
use Illuminate\Database\Seeder;
use Throwable;

class LiterarySubgenderSeeder extends Seeder
{
    protected LiterarySubgenderRepository $literarySubgenderRepository;

    /**
     * @param LiterarySubgenderRepository $literarySubgenderRepository
     */
    public function __construct(LiterarySubgenderRepository $literarySubgenderRepository)
    {
        $this->literarySubgenderRepository = $literarySubgenderRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Throwable
     */
    public function run()
    {
        $this->literarySubgenderRepository->create(['name' => 'Cuento', 'literary_gender_id' => 1]);
        $this->literarySubgenderRepository->create(['name' => 'Cuento', 'literary_gender_id' => 1]);
        $this->literarySubgenderRepository->create(['name' => 'Epopeya', 'literary_gender_id' => 1]);
        $this->literarySubgenderRepository->create(['name' => 'Novela', 'literary_gender_id' => 1]);
        $this->literarySubgenderRepository->create(['name' => 'Poema épico', 'literary_gender_id' => 1]);
        $this->literarySubgenderRepository->create(['name' => 'Cantares de gesta', 'literary_gender_id' => 1]);
        $this->literarySubgenderRepository->create(['name' => 'Fábula', 'literary_gender_id' => 1]);
        $this->literarySubgenderRepository->create(['name' => 'Leyendas', 'literary_gender_id' => 1]);
        $this->literarySubgenderRepository->create(['name' => 'Romances líricos', 'literary_gender_id' => 1]);
        $this->literarySubgenderRepository->create(['name' => 'Epístola', 'literary_gender_id' => 1]);

        $this->literarySubgenderRepository->create(['name' => 'Poema', 'literary_gender_id' => 2]);
        $this->literarySubgenderRepository->create(['name' => 'Oda', 'literary_gender_id' => 2]);
        $this->literarySubgenderRepository->create(['name' => 'Sonetos', 'literary_gender_id' => 2]);
        $this->literarySubgenderRepository->create(['name' => 'Elegía', 'literary_gender_id' => 2]);
        $this->literarySubgenderRepository->create(['name' => 'Égloga sátira', 'literary_gender_id' => 2]);
        $this->literarySubgenderRepository->create(['name' => 'Himnos', 'literary_gender_id' => 2]);
        $this->literarySubgenderRepository->create(['name' => 'Canciones', 'literary_gender_id' => 2]);

        $this->literarySubgenderRepository->create(['name' => 'Teatro', 'literary_gender_id' => 3]);
        $this->literarySubgenderRepository->create(['name' => 'Drama', 'literary_gender_id' => 3]);
        $this->literarySubgenderRepository->create(['name' => 'Comedia', 'literary_gender_id' => 3]);
        $this->literarySubgenderRepository->create(['name' => 'Amor', 'literary_gender_id' => 3]);
        $this->literarySubgenderRepository->create(['name' => 'Ópera', 'literary_gender_id' => 3]);
        $this->literarySubgenderRepository->create(['name' => 'Melodrama', 'literary_gender_id' => 3]);
        $this->literarySubgenderRepository->create(['name' => 'Farsa', 'literary_gender_id' => 3]);
        $this->literarySubgenderRepository->create(['name' => 'Tragedia', 'literary_gender_id' => 3]);

        $this->literarySubgenderRepository->create(['name' => 'Ensayo', 'literary_gender_id' => 4]);
        $this->literarySubgenderRepository->create(['name' => 'Manuales', 'literary_gender_id' => 4]);

        $this->literarySubgenderRepository->create(['name' => 'Romántica', 'literary_gender_id' => 5]);
        $this->literarySubgenderRepository->create(['name' => 'Gráfica', 'literary_gender_id' => 5]);
        $this->literarySubgenderRepository->create(['name' => 'Ciencia ficción', 'literary_gender_id' => 5]);
        $this->literarySubgenderRepository->create(['name' => 'Histórica', 'literary_gender_id' => 5]);
        $this->literarySubgenderRepository->create(['name' => 'Drama', 'literary_gender_id' => 5]);
        $this->literarySubgenderRepository->create(['name' => 'Fantástica', 'literary_gender_id' => 5]);
        $this->literarySubgenderRepository->create(['name' => 'Aventuras', 'literary_gender_id' => 5]);
        $this->literarySubgenderRepository->create(['name' => 'Breve', 'literary_gender_id' => 5]);

        $this->literarySubgenderRepository->create(['name' => 'Cuento', 'literary_gender_id' => 6]);
        $this->literarySubgenderRepository->create(['name' => 'Microrrelato', 'literary_gender_id' => 6]);

        $this->literarySubgenderRepository->create(['name' => 'Literario', 'literary_gender_id' => 7]);

        $this->literarySubgenderRepository->create(['name' => 'Épica', 'literary_gender_id' => 8]);
        $this->literarySubgenderRepository->create(['name' => 'Mística', 'literary_gender_id' => 8]);
        $this->literarySubgenderRepository->create(['name' => 'Amorosa', 'literary_gender_id' => 8]);
        $this->literarySubgenderRepository->create(['name' => 'Surrealista', 'literary_gender_id' => 8]);
        $this->literarySubgenderRepository->create(['name' => 'Epigramas', 'literary_gender_id' => 8]);
    }
}
