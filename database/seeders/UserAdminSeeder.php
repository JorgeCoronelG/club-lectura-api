<?php

namespace Database\Seeders;

use App\Contracts\Repositories\IExternalRepository;
use App\Contracts\Repositories\IUserRepository;
use App\Helpers\Enum\Gender;
use App\Models\Enums\StatusUser;
use App\Models\FormFields\RoleFields;
use App\Models\FormFields\UserFields;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    protected IUserRepository $userRepository;
    protected IExternalRepository $externalRepository;

    public function __construct(IUserRepository $userRepository, IExternalRepository $externalRepository)
    {
        $this->userRepository = $userRepository;
        $this->externalRepository = $externalRepository;
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
            'complete_name' => 'Jorge Coronel González',
            'email' => 'tprog.jorge.coronel@outlook.com',
            'password' => bcrypt('Jorge32079.'),
            'phone' => '4423178052',
            'birthday' => '1998-08-29',
            'gender' => Gender::Male->value,
            'photo' => UserFields::PHOTO_DEFAULT,
            'status' => StatusUser::Active->value,
            'verified' => UserFields::VERIFIED,
            'verification_token' => User::generateVerificationToken(),
            'email_verified_at' => now()
        ]);
        $admin->roles()->attach([RoleFields::Admin->value, RoleFields::Reader->value]);
        $this->externalRepository->create(['user_id' => $admin->id]);

        $admin = $this->userRepository->create([
            'code' => UserFields::CODE_INITIAL.'2',
            'complete_name' => 'Nancy Oviedo López',
            'email' => 'isc.nancy.oviedo@hotmail.com',
            'password' => bcrypt('password'),
            'phone' => '4421010101',
            'birthday' => '1990-01-01',
            'gender' => Gender::Female->value,
            'photo' => UserFields::PHOTO_DEFAULT,
            'status' => StatusUser::Active->value,
            'verified' => UserFields::VERIFIED,
            'verification_token' => User::generateVerificationToken(),
            'email_verified_at' => now()
        ]);
        $admin->roles()->attach([RoleFields::Admin->value, RoleFields::Reader->value]);
        $this->externalRepository->create(['user_id' => $admin->id]);
    }
}
