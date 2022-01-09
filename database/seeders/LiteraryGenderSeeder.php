<?php

namespace Database\Seeders;

use App\Contracts\Repositories\ILiteraryGenderRepository;
use Illuminate\Database\Seeder;
use Throwable;

class LiteraryGenderSeeder extends Seeder
{
    protected ILiteraryGenderRepository $literaryGenderRepository;

    /**
     * @param ILiteraryGenderRepository $literaryGenderRepository
     */
    public function __construct(ILiteraryGenderRepository $literaryGenderRepository)
    {
        $this->literaryGenderRepository = $literaryGenderRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Throwable
     */
    public function run()
    {
        $this->literaryGenderRepository->create(['name' => 'Épico']);
        $this->literaryGenderRepository->create(['name' => 'Lírico']);
        $this->literaryGenderRepository->create(['name' => 'Dramático']);
        $this->literaryGenderRepository->create(['name' => 'Didáctico']);
        $this->literaryGenderRepository->create(['name' => 'Novela']);
        $this->literaryGenderRepository->create(['name' => 'Relato']);
        $this->literaryGenderRepository->create(['name' => 'Ensayo']);
        $this->literaryGenderRepository->create(['name' => 'Poesía']);
    }
}
