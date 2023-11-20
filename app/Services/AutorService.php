<?php

namespace App\Services;

use App\Contracts\Repositories\AutorRepositoryInterface;
use App\Contracts\Services\AutorServiceInterface;
use App\Core\BaseService;
use App\Core\Contracts\BaseRepositoryInterface;

class AutorService extends BaseService implements AutorServiceInterface
{
    protected BaseRepositoryInterface $entityRepository;

    public function __construct(AutorRepositoryInterface $autorRepository)
    {
        $this->entityRepository = $autorRepository;
    }
}
