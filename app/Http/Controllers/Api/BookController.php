<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\IBookService;
use App\Core\BaseApiController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BookController extends BaseApiController
{
    protected IBookService $bookService;

    /**
     * @param IBookService $bookService
     */
    public function __construct(IBookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function findImage(string $img): BinaryFileResponse
    {
        $path = $this->bookService->findImage($img);
        return $this->fileResponse($path);
    }
}
