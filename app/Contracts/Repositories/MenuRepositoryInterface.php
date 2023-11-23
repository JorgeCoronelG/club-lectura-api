<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface MenuRepositoryInterface extends BaseRepositoryInterface
{
    public function obtenerTodosPorRolId(int $rolId): Collection;
}