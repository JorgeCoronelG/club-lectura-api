<?php

namespace App\Services;

use App\Contracts\Repositories\CatalogoOpcionRepositoryInterface;
use App\Contracts\Services\CatalogoOpcionServiceInterface;
use App\Core\BaseService;
use App\Core\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CatalogoOpcionService extends BaseService implements CatalogoOpcionServiceInterface
{
    protected BaseRepositoryInterface $entityRepository;

    public function __construct(
        CatalogoOpcionRepositoryInterface $catalogoOpcionRepository
    ) {
        $this->entityRepository = $catalogoOpcionRepository;
    }

    public function findByCatalogoId(int $catalogoId, array $omitOptions = []): Collection
    {
        return $this->entityRepository->findByCatalogoId($catalogoId, $omitOptions);
    }
}
