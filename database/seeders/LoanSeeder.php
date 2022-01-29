<?php

namespace Database\Seeders;

use App\Contracts\Repositories\IBookRepository;
use App\Contracts\Repositories\IUserRepository;
use App\Models\Book;
use App\Models\Enums\StatusBook;
use App\Models\FormFields\BookFields;
use App\Models\Loan;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    protected IBookRepository $bookRepository;
    protected IUserRepository $userRepository;

    /**
     * @param IBookRepository $bookRepository
     * @param IUserRepository $userRepository
     */
    public function __construct(IBookRepository $bookRepository, IUserRepository $userRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = $this->bookRepository->findByStatus(StatusBook::OnLoan->value);
        $books->each(function (Book $book) {
            $user = $this->userRepository->findRandom();

            $loan = Loan::factory(['user_id' => $user->id])->create();

            $loan->books()->attach([$book->id]);
        });
    }
}
