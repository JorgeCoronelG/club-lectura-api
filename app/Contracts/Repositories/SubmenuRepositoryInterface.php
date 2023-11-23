<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface SubmenuRepositoryInterface extends BaseRepositoryInterface
{
    public function obtenerTodosPorRolId(int $rolId): Collection;
}
