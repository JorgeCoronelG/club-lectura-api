<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;
use App\Models\Multa;

interface MultaRepositoryInterface extends BaseRepositoryInterface
{
    public function updateFines(float $amount): int;

    public function findByLoanId(int $loanId): ?Multa;

    public function countAllFines(int $userId = null): int;
}
