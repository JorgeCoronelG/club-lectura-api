<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\IRoleService;
use App\Core\BaseApiController;
use App\Helpers\Cache;
use App\Helpers\Enum\CacheKey;
use App\Http\Resources\Role\RoleCollection;
use App\Models\FormFields\RoleFields;
use Illuminate\Http\JsonResponse;

class RoleController extends BaseApiController
{
    private IRoleService $roleService;

    /**
     * @param IRoleService $roleService
     */
    public function __construct(IRoleService $roleService)
    {
        $this->middleware('permission:'.implode(',', [RoleFields::Admin->value, RoleFields::Capturist->value]))
            ->only('findAll');
        $this->roleService = $roleService;
    }

    /**
     * @throws \Exception
     */
    public function findAll(): JsonResponse
    {
        $roles = Cache::apply(
            Cache::getKey(CacheKey::ROLES_FIND_ALL->value),
            now()->addDays(7),
            $this->roleService->findAll([], 'name')
        );

        return $this->showAll(new RoleCollection($roles));
    }
}
