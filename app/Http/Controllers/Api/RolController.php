<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\RolServiceInterface;
use App\Core\BaseApiController;
use App\Http\Resources\Rol\RolResource;
use Illuminate\Http\JsonResponse;

class RolController extends BaseApiController
{
    private RolServiceInterface $rolService;

    public function __construct(RolServiceInterface $rolService)
    {
        $this->rolService = $rolService;
    }

    public function findAll(): JsonResponse
    {
        $roles = $this->rolService->findAll();
        return $this->showAll(RolResource::collection($roles));
    }
}
