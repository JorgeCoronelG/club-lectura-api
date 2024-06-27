<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;

interface MultaRepositoryInterface extends BaseRepositoryInterface
{
    public function updateFines(float $amount): int;
}
