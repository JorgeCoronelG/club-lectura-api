<?php

namespace App\Services;

use App\Contracts\Repositories\IBookRepository;
use App\Contracts\Services\IBookService;
use App\Core\BaseService;
use App\Core\Contracts\IBaseRepository;
use App\Core\Contracts\IBaseService;
use App\Exceptions\CustomErrorException;
use App\Helpers\Enum\Message;
use App\Models\Book;
use App\Models\Enums\StatusBook;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @throws CustomErrorException
     */
    public function findByIdPortal(int $id): Book
    {
        $book = $this->entityRepository->findByIdPortal($id);
        if ($book->status === StatusBook::Lost->value || $book->status === StatusBook::NotRecovered->value) {
            throw new CustomErrorException(Message::MODEL_NOT_FOUND_EXCEPTION, Response::HTTP_NOT_FOUND);
        }
        return $book;
    }

    public function findMostRead(int $records = 10): Collection
    {
        return $this->entityRepository->findMostRead($records);
    }
}
