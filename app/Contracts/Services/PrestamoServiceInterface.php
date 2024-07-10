<?php

namespace App\Contracts\Services;

use App\Core\Contracts\BaseServiceInterface;
use App\Models\Dto\PrestamoDto;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @method Prestamo create(\Spatie\LaravelData\Data $data)
 * @method Prestamo findById(int $id, array $columns = ['*'])
 */
interface PrestamoServiceInterface extends BaseServiceInterface
{
    public function deliver(PrestamoDto $data, int $id): void;

    public function findAllByReaderPaginated(Request $request, int $userId): LengthAwarePaginator;
}
