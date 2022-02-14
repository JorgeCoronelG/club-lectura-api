<?php

namespace Database\Seeders;

use App\Contracts\Repositories\IAuthorRepository;
use App\Contracts\Repositories\IBookRepository;
use App\Contracts\Repositories\IDonationRepository;
use App\Contracts\Repositories\ILiterarySubgenderRepository;
use App\Models\Book;
use App\Models\FormFields\BookFields;
use App\Models\Donation;
use Illuminate\Database\Seeder;
use Throwable;

class BookSeeder extends Seeder
{
    protected IDonationRepository $donationRepository;
    protected ILiterarySubgenderRepository $literarySubgenderRepository;
    protected IAuthorRepository $authorRepository;
    protected IBookRepository $bookRepository;

    /**
     * @param IDonationRepository $donationRepository
     * @param ILiterarySubgenderRepository $literarySubgenderRepository
     * @param IAuthorRepository $authorRepository
     * @param IBookRepository $bookRepository
     */
    public function __construct(
        IDonationRepository $donationRepository,
        ILiterarySubgenderRepository $literarySubgenderRepository,
        IAuthorRepository $authorRepository,
        IBookRepository $bookRepository
    ) {
        $this->donationRepository = $donationRepository;
        $this->literarySubgenderRepository = $literarySubgenderRepository;
        $this->authorRepository = $authorRepository;
        $this->bookRepository = $bookRepository;
    }


    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Throwable
     */
    public function run()
    {
        $donations = $this->donationRepository->findAll();

        $donations->each(function (Donation $donation) {
            $subgender = $this->literarySubgenderRepository->findRandom();

            $bookData = Book::factory()->definition();
            $book = $this->bookRepository->create(array_merge($bookData, [
                'donation_id' => $donation->id,
                'literary_subgender_id' => $subgender->id
            ]));

            $book->code = BookFields::CODE_INITIAL.$book->id;
            $book->save();

            $authors = $this->authorRepository->findRandoms(rand(1,3))->pluck('id');
            $book->authors()->attach($authors);
        });
    }
}
