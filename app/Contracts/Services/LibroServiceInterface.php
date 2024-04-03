<?php

namespace App\Contracts\Services;

use App\Core\Contracts\BaseServiceInterface;
use App\Models\Dto\LibroDto;
use App\Models\Libro;

/**
 * @method Libro create(LibroDto $data)
 * @method Libro update(int $id, LibroDto $data)
 */
interface LibroServiceInterface extends BaseServiceInterface
{
    //
}
