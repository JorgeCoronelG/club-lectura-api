<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\IBaseRepository;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 08/01/2022
 *
 * @method Book create(array $data)
 */
interface IBookRepository extends IBaseRepository
{
    public function findAllByStatus(array|int $status): Collection;

    public function findAllPortalPaginated(array $filters, int $limit, array $authorsId, string $sort = null,
        array $columns = ['*']): LengthAwarePaginator;

    public function findByIdPortal(int $id): Book;

    public function findMostRead(int $records = 10): Collection;
}
