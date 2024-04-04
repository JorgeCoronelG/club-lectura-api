<?php

namespace App\Contracts\Services;

use App\Core\Contracts\BaseServiceInterface;
use App\Models\Dto\LibroDto;
use App\Models\Libro;

/**
 * @method Libro create(LibroDto $data)
 * @method Libro update(int $id, LibroDto $data)
 * @method Libro findById(int $id, array $columns = ['*'])
 */
interface LibroServiceInterface extends BaseServiceInterface
{
    public function updateImage(int $id, LibroDto $data): void;
}
