<?php

namespace App\Services;

use App\Contracts\Repositories\PrestamoRepositoryInterface;
use App\Contracts\Services\PrestamoServiceInterface;
use App\Core\BaseService;
use App\Core\Contracts\BaseRepositoryInterface;

class PrestamoService extends BaseService implements PrestamoServiceInterface
{
    protected BaseRepositoryInterface $entityRepository;

    public function __construct(
        PrestamoRepositoryInterface $prestamoRepository
    ) {
        $this->entityRepository = $prestamoRepository;
    }
}
