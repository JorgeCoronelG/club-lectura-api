<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;
use App\Models\Libro;

/**
 * @method Libro create(array $data)
 * @method Libro update(int $id, array $data)
 * @method Libro findById(int $id, array $columns = ['*'])
 */
interface LibroRepositoryInterface extends BaseRepositoryInterface
{
    //
}
