<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\RolServiceInterface;
use App\Core\BaseApiController;
use App\Http\Resources\Rol\RolResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RolController extends BaseApiController
{
    private RolServiceInterface $rolService;

    public function __construct(RolServiceInterface $rolService)
    {
        $this->rolService = $rolService;
    }

    public function findAll(Request $request): JsonResponse
    {
        $roles = $this->rolService->findAll($request);
        return $this->showAll(RolResource::collection($roles));
    }
}
