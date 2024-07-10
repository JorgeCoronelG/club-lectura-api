<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;
use App\Models\Prestamo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @method Prestamo create(array $data)
 * @method Prestamo findById(int $id, array $columns = ['*'])
 */
interface PrestamoRepositoryInterface extends BaseRepositoryInterface
{
    public function loansByUserId(int $userId): Collection;

    public function loansForFines(array $columns = ['*']): Collection;

    public function findAllByReaderPaginated(int $userId, array $filters, int $limit, string $sort = null, array $columns = ['*']): LengthAwarePaginator;

    public function countAllLoans(int $userId = null): int;

    public function countActiveLoans(int $userId = null): int;
}
