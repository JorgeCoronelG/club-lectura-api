<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\LibroServiceInterface;
use App\Core\BaseApiController;
use App\Http\Resources\Libro\LibroCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LibroController extends BaseApiController
{
    private LibroServiceInterface $libroService;

    public function __construct(
        LibroServiceInterface $libroService
    ) {
        $this->libroService = $libroService;
    }

    public function index(Request $request): JsonResponse
    {
        $books = $this->libroService->findAllPaginated($request);
        return $this->showAll(new LibroCollection($books, true));
    }
}
