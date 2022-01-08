<?php

namespace Database\Seeders;

use App\Models\LiterarySubgender;
use Illuminate\Database\Seeder;

class LiterarySubgenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LiterarySubgender::create(['name' => 'Cuento', 'literary_gender_id' => 1]);
        LiterarySubgender::create(['name' => 'Epopeya', 'literary_gender_id' => 1]);
        LiterarySubgender::create(['name' => 'Novela', 'literary_gender_id' => 1]);
        LiterarySubgender::create(['name' => 'Poema épico', 'literary_gender_id' => 1]);
        LiterarySubgender::create(['name' => 'Cantares de gesta', 'literary_gender_id' => 1]);
        LiterarySubgender::create(['name' => 'Fábula', 'literary_gender_id' => 1]);
        LiterarySubgender::create(['name' => 'Leyendas', 'literary_gender_id' => 1]);
        LiterarySubgender::create(['name' => 'Romances líricos', 'literary_gender_id' => 1]);
        LiterarySubgender::create(['name' => 'Epístola', 'literary_gender_id' => 1]);

        LiterarySubgender::create(['name' => 'Poema', 'literary_gender_id' => 2]);
        LiterarySubgender::create(['name' => 'Oda', 'literary_gender_id' => 2]);
        LiterarySubgender::create(['name' => 'Sonetos', 'literary_gender_id' => 2]);
        LiterarySubgender::create(['name' => 'Elegía', 'literary_gender_id' => 2]);
        LiterarySubgender::create(['name' => 'Égloga sátira', 'literary_gender_id' => 2]);
        LiterarySubgender::create(['name' => 'Himnos', 'literary_gender_id' => 2]);
        LiterarySubgender::create(['name' => 'Canciones', 'literary_gender_id' => 2]);

        LiterarySubgender::create(['name' => 'Teatro', 'literary_gender_id' => 3]);
        LiterarySubgender::create(['name' => 'Drama', 'literary_gender_id' => 3]);
        LiterarySubgender::create(['name' => 'Comedia', 'literary_gender_id' => 3]);
        LiterarySubgender::create(['name' => 'Amor', 'literary_gender_id' => 3]);
        LiterarySubgender::create(['name' => 'Ópera', 'literary_gender_id' => 3]);
        LiterarySubgender::create(['name' => 'Melodrama', 'literary_gender_id' => 3]);
        LiterarySubgender::create(['name' => 'Farsa', 'literary_gender_id' => 3]);
        LiterarySubgender::create(['name' => 'Tragedia', 'literary_gender_id' => 3]);

        LiterarySubgender::create(['name' => 'Ensayo', 'literary_gender_id' => 4]);
        LiterarySubgender::create(['name' => 'Manuales', 'literary_gender_id' => 4]);

        LiterarySubgender::create(['name' => 'Romántica', 'literary_gender_id' => 5]);
        LiterarySubgender::create(['name' => 'Gráfica', 'literary_gender_id' => 5]);
        LiterarySubgender::create(['name' => 'Ciencia ficción', 'literary_gender_id' => 5]);
        LiterarySubgender::create(['name' => 'Histórica', 'literary_gender_id' => 5]);
        LiterarySubgender::create(['name' => 'Drama', 'literary_gender_id' => 5]);
        LiterarySubgender::create(['name' => 'Fantástica', 'literary_gender_id' => 5]);
        LiterarySubgender::create(['name' => 'Aventuras', 'literary_gender_id' => 5]);
        LiterarySubgender::create(['name' => 'Breve', 'literary_gender_id' => 5]);

        LiterarySubgender::create(['name' => 'Cuento', 'literary_gender_id' => 6]);
        LiterarySubgender::create(['name' => 'Microrrelato', 'literary_gender_id' => 6]);

        LiterarySubgender::create(['name' => 'Literario', 'literary_gender_id' => 7]);

        LiterarySubgender::create(['name' => 'Épica', 'literary_gender_id' => 8]);
        LiterarySubgender::create(['name' => 'Mística', 'literary_gender_id' => 8]);
        LiterarySubgender::create(['name' => 'Amorosa', 'literary_gender_id' => 8]);
        LiterarySubgender::create(['name' => 'Surrealista', 'literary_gender_id' => 8]);
        LiterarySubgender::create(['name' => 'Epigramas', 'literary_gender_id' => 8]);
    }
}
