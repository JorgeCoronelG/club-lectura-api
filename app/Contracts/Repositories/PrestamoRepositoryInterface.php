<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;
use App\Models\Prestamo;
use Illuminate\Database\Eloquent\Collection;

/**
 * @method Prestamo create(array $data)
 * @method Prestamo findById(int $id, array $columns = ['*'])
 */
interface PrestamoRepositoryInterface extends BaseRepositoryInterface
{
    public function loansByUserId(int $userId): Collection;

    public function loansForFines(array $columns = ['*']): Collection;
}
