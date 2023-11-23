<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;
use App\Models\CatalogoOpcion;

interface CatalogoOpcionRepositoryInterface extends BaseRepositoryInterface
{
    public function buscarPorOpcionIdYCatalogoId(int $opcionId, int $catalogoId): CatalogoOpcion;
}
