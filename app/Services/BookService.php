<?php

namespace App\Services;

use App\Contracts\Repositories\IBookRepository;
use App\Contracts\Services\IBookService;
use App\Core\BaseService;
use App\Core\Contracts\IBaseRepository;
use App\Core\Contracts\IBaseService;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 09/02/2022
 */
class BookService extends BaseService implements IBookService
{
    protected IBaseRepository $entityRepository;

    public function __construct(IBookRepository $bookRepository)
    {
        $this->entityRepository = $bookRepository;
    }

    public function findMostRead(int $records = 10): Collection
    {
        return $this->entityRepository->findMostRead($records);
    }

    public function findOnePortal($id): Book
    {
        return $this->entityRepository
            ->with(['authors', 'literarySubgender.literaryGender'])
            ->findById($id);
    }
}
