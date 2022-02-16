<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\IBaseRepository;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

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
}
