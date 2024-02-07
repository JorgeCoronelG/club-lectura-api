<?php

namespace App\Services;

use App\Contracts\Repositories\RolRepositoryInterface;
use App\Contracts\Services\RolServiceInterface;
use App\Core\BaseService;
use App\Core\Contracts\BaseRepositoryInterface;

class RolService extends BaseService implements RolServiceInterface
{
    protected BaseRepositoryInterface $entityRepository;

    public function __construct(
        RolRepositoryInterface $rolRepository
    ) {
        $this->entityRepository = $rolRepository;
    }
}
