<?php

namespace Database\Seeders;

use App\Models\Academic;
use App\Models\Constants\RoleFields;
use App\Models\External;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public const TOTAL_USERS_CAPTURIST = 5;
    public const TOTAL_USERS_READER = 50;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->times(self::TOTAL_USERS_CAPTURIST)
            ->create()
            ->each(function (User $user) {
                $user->code = "CLUB/LECT-$user->id";
                $user->save();

                $user->roles()->attach([RoleFields::CAPTURIST, RoleFields::READER]);

                Student::factory(['user_id' => $user->id])->create();
            });

        User::factory()
            ->times(self::TOTAL_USERS_READER)
            ->create()
            ->each(function (User $user) {
                $user->code = "CLUB/LECT-$user->id";
                $user->save();

                $user->roles()->attach(RoleFields::READER);

                $type = rand(1,3);
                if ($type === 1) {
                    Student::factory(['user_id' => $user->id])->create();
                }
                if ($type === 2) {
                    Academic::factory(['user_id' => $user->id])->create();
                }
                if ($type === 3) {
                    External::create(['user_id' => $user->id]);
                }
            });
    }
}
