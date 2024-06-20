<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\PrestamoServiceInterface;
use App\Core\BaseApiController;
use App\Http\Resources\Prestamo\PrestamoCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrestamoController extends BaseApiController
{
    private PrestamoServiceInterface $prestamoService;

    public function __construct(
        PrestamoServiceInterface $prestamoService
    ) {
        $this->prestamoService = $prestamoService;
    }

    public function index(Request $request): JsonResponse
    {
        $loans = $this->prestamoService->findAllPaginated($request);
        return $this->showAll(new PrestamoCollection($loans, true));
    }
}
