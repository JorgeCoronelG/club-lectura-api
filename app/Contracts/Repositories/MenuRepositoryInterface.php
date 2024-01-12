<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface MenuRepositoryInterface extends BaseRepositoryInterface
{
    public function findAllByRolId(int $rolId): Collection;

    public function getPathRouteNavigationByUserId(int $userId): Collection;

    public function findByUserId(int $userId): Collection;
}
