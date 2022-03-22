<?php

namespace Database\Seeders;

use App\Contracts\Repositories\IExternalRepository;
use App\Models\Academic;
use App\Models\Enums\TypeAcademic;
use App\Models\FormFields\RoleFields;
use App\Models\FormFields\UserFields;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    protected IExternalRepository $externalRepository;

    public const TOTAL_USERS_CAPTURIST = 5;
    public const TOTAL_USERS_READER = 50;

    /**
     * @param IExternalRepository $externalRepository
     */
    public function __construct(IExternalRepository $externalRepository)
    {
        $this->externalRepository = $externalRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesCapturist = [RoleFields::Capturist->value, RoleFields::Reader->value];
        $roleReader = RoleFields::Reader->value;

        User::factory()
            ->times(self::TOTAL_USERS_CAPTURIST)
            ->create()
            ->each(function (User $user) use ($rolesCapturist) {
                $user->code = UserFields::CODE_INITIAL.$user->id;
                $user->save();

                $user->roles()->attach($rolesCapturist);

                Student::factory(['user_id' => $user->id])->create();
            });

        User::factory()
            ->times(self::TOTAL_USERS_READER)
            ->create()
            ->each(function (User $user) use ($roleReader) {
                $user->code = UserFields::CODE_INITIAL.$user->id;
                $user->save();

                $user->roles()->attach($roleReader);

                $type = rand(1,3);
                if ($type === TypeAcademic::Teacher->value) {
                    Student::factory(['user_id' => $user->id])->create();
                }
                if ($type === TypeAcademic::Administrative->value) {
                    Academic::factory(['user_id' => $user->id])->create();
                }
                if ($type === TypeAcademic::GeneralStaff->value) {
                    $this->externalRepository->create(['user_id' => $user->id]);
                }
            });
    }
}
