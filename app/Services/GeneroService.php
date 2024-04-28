<?php

namespace App\Services;

use App\Contracts\Repositories\GeneroRepositoryInterface;
use App\Contracts\Services\GeneroServiceInterface;
use App\Core\BaseService;
use App\Core\Contracts\BaseRepositoryInterface;

class GeneroService extends BaseService implements GeneroServiceInterface
{
    protected BaseRepositoryInterface $entityRepository;

    public function __construct(GeneroRepositoryInterface $generoRepository)
    {
        $this->entityRepository = $generoRepository;
    }
}
