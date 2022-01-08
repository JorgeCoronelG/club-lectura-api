<?php

namespace Database\Seeders;

use App\Models\LiteraryGender;
use Illuminate\Database\Seeder;

class LiteraryGenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LiteraryGender::create(['name' => 'Épico']);
        LiteraryGender::create(['name' => 'Lírico']);
        LiteraryGender::create(['name' => 'Dramático']);
        LiteraryGender::create(['name' => 'Didáctico']);
        LiteraryGender::create(['name' => 'Novela']);
        LiteraryGender::create(['name' => 'Relato']);
        LiteraryGender::create(['name' => 'Ensayo']);
        LiteraryGender::create(['name' => 'Poesía']);
    }
}
