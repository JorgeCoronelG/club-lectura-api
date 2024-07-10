<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;
use App\Models\Libro;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @method Libro create(array $data)
 * @method Libro update(int $id, array $data)
 * @method Libro findById(int $id, array $columns = ['*'])
 */
interface LibroRepositoryInterface extends BaseRepositoryInterface
{
    public function findAllLibraryPaginated(array $filters, int $limit, string $sort = null, array $columns = ['*']): LengthAwarePaginator;

    public function findBooksOnLoan(array $bookIds): Collection;

    public function findAllForLoan(): Collection;

    public function countExistBooks(): int;
}
