<?php

namespace App\Contracts\Services;

use App\Core\Contracts\BaseServiceInterface;
use App\Models\Dto\LibroDto;
use App\Models\Libro;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @method Libro create(LibroDto $data)
 * @method Libro update(int $id, LibroDto $data)
 * @method Libro findById(int $id, array $columns = ['*'])
 */
interface LibroServiceInterface extends BaseServiceInterface
{
    public function updateImage(int $id, LibroDto $data): void;

    public function findAllLibraryPaginated(Request $request, array $columns = ['*']): LengthAwarePaginator;

    public function findAllForLoan(): Collection;
}
