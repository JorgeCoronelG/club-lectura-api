<?php

namespace App\Services;

use App\Contracts\Repositories\IRoleRepository;
use App\Contracts\Services\IRoleService;
use App\Core\BaseService;
use App\Core\Contracts\IBaseRepository;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 09/03/2022
 */
class RoleService extends BaseService implements IRoleService
{
    protected IBaseRepository $entityRepository;

    /**
     * @param IRoleRepository $roleRepository
     */
    public function __construct(IRoleRepository $roleRepository)
    {
        $this->entityRepository = $roleRepository;
    }
}
