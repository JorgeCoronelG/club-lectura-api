<?php

namespace Database\Seeders;

use App\Models\Academic;
use App\Models\Author;
use App\Models\Book;
use App\Models\Donation;
use App\Models\External;
use App\Models\Fine;
use App\Models\LiteraryGender;
use App\Models\LiterarySubgender;
use App\Models\Loan;
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
        DB::table('authors')->truncate();
        DB::table('donations')->truncate();
        DB::table('donation_user')->truncate();
        DB::table('books')->truncate();
        DB::table('author_book')->truncate();
        DB::table('loans')->truncate();
        DB::table('book_loan')->truncate();
        DB::table('fines')->truncate();

        Role::flushEventListeners();
        User::flushEventListeners();
        Student::flushEventListeners();
        Academic::flushEventListeners();
        External::flushEventListeners();
        LiteraryGender::flushEventListeners();
        LiterarySubgender::flushEventListeners();
        Author::flushEventListeners();
        Donation::flushEventListeners();
        Book::flushEventListeners();
        Loan::flushEventListeners();
        Fine::flushEventListeners();

        $this->call(RoleSeeder::class);
        $this->call(UserAdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LiteraryGenderSeeder::class);
        $this->call(LiterarySubgenderSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(DonationSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(LoanSeeder::class);
        $this->call(FineSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
