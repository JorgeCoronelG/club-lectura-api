<?php

namespace Database\Seeders;

use App\Contracts\Repositories\IRoleRepository;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    protected IRoleRepository $roleRepository;

    /**
     * @param IRoleRepository $roleRepository
     */
    public function __construct(IRoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->roleRepository->create(['name' => 'Administrador']);
        $this->roleRepository->create(['name' => 'Capturista']);
        $this->roleRepository->create(['name' => 'Lector']);
    }
}
