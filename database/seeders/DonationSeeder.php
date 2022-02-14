<?php

namespace Database\Seeders;

use App\Contracts\Repositories\IUserRepository;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    protected IUserRepository $userRepository;

    /**
     * @param IUserRepository $userRepository
     */
    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reasons = [
            'Un estudiante',
            'Un profesor',
            'Página web',
            'Por mi hijo(a)',
            'Redes sociales'
        ];
        $users = $this->userRepository->findAll();

        $users->each(function (User $user) use ($reasons) {
            $donation = Donation::factory()->create();

            $user->donations()->attach($donation->id, ['reason' => $reasons[array_rand($reasons)]]);
        });
    }
}
