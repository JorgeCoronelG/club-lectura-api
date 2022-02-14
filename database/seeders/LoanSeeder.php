<?php

namespace Database\Seeders;

use App\Contracts\Repositories\IBookRepository;
use App\Contracts\Repositories\ILoanRepository;
use App\Contracts\Repositories\IUserRepository;
use App\Models\Book;
use App\Models\Enums\StatusBook;
use App\Models\Loan;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    protected IBookRepository $bookRepository;
    protected IUserRepository $userRepository;
    protected ILoanRepository $loanRepository;

    /**
     * @param IBookRepository $bookRepository
     * @param IUserRepository $userRepository
     * @param ILoanRepository $loanRepository
     */
    public function __construct(
        IBookRepository $bookRepository,
        IUserRepository $userRepository,
        ILoanRepository $loanRepository
    ) {
        $this->bookRepository = $bookRepository;
        $this->userRepository = $userRepository;
        $this->loanRepository = $loanRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = $this->bookRepository->findByField('status', StatusBook::OnLoan->value);
        $books->each(function (Book $book) {
            $user = $this->userRepository->findRandom();

            $loanData = Loan::factory()->definition();
            $loan = $this->loanRepository->create(array_merge($loanData, ['user_id' => $user->id]));

            $loan->books()->attach([$book->id]);
        });
    }
}
