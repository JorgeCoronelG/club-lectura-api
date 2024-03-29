<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface SubmenuRepositoryInterface extends BaseRepositoryInterface
{
    public function findAllByRolId(int $rolId): Collection;

    public function findByUserId(int $userId): Collection;
}
