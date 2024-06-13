<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\CatalogoOpcionServiceInterface;
use App\Core\BaseApiController;
use App\Http\Resources\CatalogoOpcion\CatalogoOpcionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CatalogoOpcionController extends BaseApiController
{
    protected CatalogoOpcionServiceInterface $catalogoOpcionService;

    public function __construct(
        CatalogoOpcionServiceInterface $catalogoOpcionService
    ) {
        $this->catalogoOpcionService = $catalogoOpcionService;
    }

    public function findByCatalogoId(int $catalogoId, Request $request): JsonResponse
    {
        $omitOptions = [];
        if (!is_null($request->get('omit_options'))) {
            $omitOptions = array_map(fn ($row) => intval($row), explode(',', $request->get('omit_options')));
        }

        $optionsCatalog = $this->catalogoOpcionService->findByCatalogoId($catalogoId, $omitOptions);
        return $this->showAll(CatalogoOpcionResource::collection($optionsCatalog));
    }
}
