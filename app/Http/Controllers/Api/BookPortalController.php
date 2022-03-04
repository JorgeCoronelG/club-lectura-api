<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\IBookService;
use App\Core\BaseApiController;
use App\Helpers\Cache;
use App\Helpers\Enum\CacheKey;
use App\Http\Resources\Book\BookPortalCollection;
use App\Http\Resources\Book\BookPortalResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookPortalController extends BaseApiController
{
    protected IBookService $bookService;

    public function __construct(IBookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function findAllPortal(Request $request): JsonResponse
    {
        $books = $this->bookService->findAllPortalPaginated($request);
        return $this->showAll(new BookPortalCollection($books, true));
    }

    public function findOnePortal(int $id): JsonResponse
    {
        $book = $this->bookService->findByIdPortal($id);
        return $this->showOne(new BookPortalResource($book));
    }

    /**
     * @throws \Exception
     */
    public function findLatest(): JsonResponse
    {
        $booksLatest = Cache::apply(CacheKey::BOOK_PORTAL_FIND_LATEST->value, now()->addDay(), $this->bookService->findRecordsLatest());
        return $this->showAll(new BookPortalCollection($booksLatest));
    }

    /**
     * @throws \Exception
     */
    public function findMostRead(): JsonResponse
    {
        $booksMostRead = Cache::apply(CacheKey::BOOK_PORTAL_MOST_READ->value, now()->addDay(), $this->bookService->findMostRead());
        return $this->showAll(new BookPortalCollection($booksMostRead));
    }

    public function getMaxMinPages(): JsonResponse
    {
        $book = $this->bookService->getMinMaxPages();
        return $this->successResponse(['data' => [
            'minPages' => $book->min_pages,
            'maxPages' => $book->max_pages
        ]], Response::HTTP_OK);
    }
}
