<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\IBookRepository;
use App\Core\BaseApiController;
use App\Http\Resources\Book\BookPortalCollection;
use Illuminate\Http\JsonResponse;

class BookController extends BaseApiController
{
    protected IBookRepository $bookRepository;

    /**
     * @param IBookRepository $bookRepository
     */
    public function __construct(IBookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function latest(): JsonResponse
    {
        $booksLatest = $this->bookRepository->findRecordsLatest();
        return $this->showAll(new BookPortalCollection($booksLatest));
    }
}
