<?php

namespace App\Services;

use App\Contracts\Repositories\LibroRepositoryInterface;
use App\Contracts\Services\LibroServiceInterface;
use App\Core\BaseService;
use App\Core\Contracts\BaseRepositoryInterface;

class LibroService extends BaseService implements LibroServiceInterface
{
    protected BaseRepositoryInterface $entityRepository;

    public function __construct(
        LibroRepositoryInterface $libroRepository,
    ) {
        $this->entityRepository = $libroRepository;
    }
}
