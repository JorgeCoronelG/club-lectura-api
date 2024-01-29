<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;
use App\Models\CatalogoOpcion;
use Illuminate\Database\Eloquent\Collection;

interface CatalogoOpcionRepositoryInterface extends BaseRepositoryInterface
{
    public function findByOpcionIdAndCatalogoId(int $opcionId, int $catalogoId): CatalogoOpcion;

    public function findByCatalogoId(int $catalogoId): Collection;
}
