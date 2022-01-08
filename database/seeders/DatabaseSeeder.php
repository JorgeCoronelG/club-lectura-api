<?php

namespace Database\Seeders;

use App\Models\Academic;
use App\Models\External;
use App\Models\LiteraryGender;
use App\Models\LiterarySubgender;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('roles')->truncate();
        DB::table('role_user')->truncate();
        DB::table('users')->truncate();
        DB::table('students')->truncate();
        DB::table('academics')->truncate();
        DB::table('externals')->truncate();
        DB::table('literary_genders')->truncate();
        DB::table('literary_subgenders')->truncate();

        Role::flushEventListeners();
        User::flushEventListeners();
        Student::flushEventListeners();
        Academic::flushEventListeners();
        External::flushEventListeners();
        LiteraryGender::flushEventListeners();
        LiterarySubgender::flushEventListeners();

        $this->call(RoleSeeder::class);
        $this->call(UserAdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LiteraryGenderSeeder::class);
        $this->call(LiterarySubgenderSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
