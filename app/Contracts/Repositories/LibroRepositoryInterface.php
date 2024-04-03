<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;
use App\Models\Libro;

/**
 * @method Libro create(array $data)
 * @method Libro update(int $id, array $data)
 */
interface LibroRepositoryInterface extends BaseRepositoryInterface
{
    //
}
