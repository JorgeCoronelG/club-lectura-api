<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;
use App\Models\Genero;

/**
 * @method Genero[] findAll(array $filter = [], string $sort = null, array $columns = ['*'])
 */
interface GeneroRepositoryInterface extends BaseRepositoryInterface
{
    //
}
