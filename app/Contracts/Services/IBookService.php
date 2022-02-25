<?php

namespace App\Contracts\Services;

use App\Core\Contracts\IBaseService;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 09/02/2022
 */
interface IBookService extends IBaseService
{
    public function findAllPortalPaginated(Request $request): LengthAwarePaginator;

    public function findByIdPortal(int $id): Book;

    public function findMostRead(int $records = 10): Collection;

    public function getMinMaxPages(): Book;
}
