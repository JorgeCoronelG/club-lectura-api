<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\PrestamoServiceInterface;
use App\Core\BaseApiController;
use App\Http\Requests\Loan\DeliveredLoanRequest;
use App\Http\Requests\Loan\StoreLoanRequest;
use App\Http\Resources\Prestamo\PrestamoCollection;
use App\Http\Resources\Prestamo\PrestamoResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    public function store(StoreLoanRequest $request): JsonResponse
    {
        $loan = $this->prestamoService->create($request->toData());
        return $this->showOne(PrestamoResource::make($loan));
    }

    public function deliver(DeliveredLoanRequest $request, int $id): Response
    {
        $this->prestamoService->deliver($request->toData(), $id);
        return $this->noContentResponse();
    }

    public function show(int $id): JsonResponse
    {
        $loan = $this->prestamoService->findById($id);
        return $this->showOne(PrestamoResource::make($loan));
    }

    public function findAllByReaderPaginated(Request $request): JsonResponse
    {
        $loans = $this->prestamoService->findAllByReaderPaginated($request, auth()->id());
        return $this->showAll(new PrestamoCollection($loans, true));
    }
}
