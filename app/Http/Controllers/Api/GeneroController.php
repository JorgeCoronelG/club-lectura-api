<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\GeneroServiceInterface;
use App\Core\BaseApiController;
use App\Http\Resources\Genero\GeneroResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeneroController extends BaseApiController
{
    private GeneroServiceInterface $generoService;

    public function __construct(GeneroServiceInterface $generoService)
    {
        $this->generoService = $generoService;
    }

    public function findAll(Request $request): JsonResponse
    {
        $genres = $this->generoService->findAll($request);
        return $this->showAll(GeneroResource::collection($genres));
    }
}
