<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\CatalogoOpcionServiceInterface;
use App\Core\BaseApiController;
use App\Http\Resources\CatalogoOpcion\CatalogoOpcionResource;
use Illuminate\Http\JsonResponse;

class CatalogoOpcionController extends BaseApiController
{
    protected CatalogoOpcionServiceInterface $catalogoOpcionService;

    public function __construct(
        CatalogoOpcionServiceInterface $catalogoOpcionService
    ) {
        $this->catalogoOpcionService = $catalogoOpcionService;
    }

    public function findByCatalogoId(int $catalogoId): JsonResponse
    {
        $optionsCatalog = $this->catalogoOpcionService->findByCatalogoId($catalogoId);
        return $this->showAll(CatalogoOpcionResource::collection($optionsCatalog));
    }
}
