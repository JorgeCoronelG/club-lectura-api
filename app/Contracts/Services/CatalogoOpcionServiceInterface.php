<?php

namespace App\Contracts\Services;

use App\Core\Contracts\BaseServiceInterface;
use Illuminate\Database\Eloquent\Collection;

interface CatalogoOpcionServiceInterface extends BaseServiceInterface
{
    public function findByCatalogoId(int $catalogoId, array $omitOptions = []): Collection;
}
