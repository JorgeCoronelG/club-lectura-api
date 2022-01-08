<?php

namespace Database\Seeders;

use App\Contracts\Repositories\IUserRepository;
use App\Models\Constants\RoleFields;
use App\Models\Constants\UserFields;
use App\Models\External;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    protected IUserRepository $userRepository;

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
        $admin = $this->userRepository->create([
            'code' => UserFields::CODE_INITIAL.'1',
            'name' => 'Jorge',
            'paternal_surname' => 'Coronel',
            'maternal_surname' => 'González',
            'email' => 'tprog.jorge.coronel@outlook.com',
            'password' => bcrypt('Jorge32079.'),
            'phone' => '4423178052',
            'birthday' => '1998-08-29',
            'gender' => UserFields::MALE_GENDER,
            'photo' => null,
            'status' => UserFields::ACTIVE_STATUS,
            'verified' => UserFields::VERIFIED,
            'verification_token' => User::generateVerificationToken(),
            'email_verified_at' => now()
        ]);
        $admin->roles()->attach([RoleFields::ADMIN, RoleFields::READER]);
        External::create(['user_id' => $admin->id]);
    }
}
