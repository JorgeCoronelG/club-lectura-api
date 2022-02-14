<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\IBookService;
use App\Core\BaseApiController;
use App\Http\Resources\Book\BookPortalCollection;
use App\Http\Resources\Book\BookPortalResource;
use Illuminate\Http\JsonResponse;

class BookController extends BaseApiController
{
    protected IBookService $bookService;

    public function __construct(IBookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function findOnePortal(int $id): JsonResponse
    {
        $book = $this->bookService->findOnePortal($id);
        return $this->showOne(new BookPortalResource($book));
    }

    public function findLatest(): JsonResponse
    {
        $booksLatest = $this->bookService->findRecordsLatest();
        return $this->showAll(new BookPortalCollection($booksLatest));
    }

    public function findMostRead(): JsonResponse
    {
        $booksMostRead = $this->bookService->findMostRead();
        return $this->showAll(new BookPortalCollection($booksMostRead));
    }
}
