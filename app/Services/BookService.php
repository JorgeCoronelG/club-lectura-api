<?php

namespace App\Services;

use App\Contracts\Repositories\IAuthorRepository;
use App\Contracts\Repositories\IBookRepository;
use App\Contracts\Services\IBookService;
use App\Core\BaseService;
use App\Core\Contracts\IBaseRepository;
use App\Exceptions\CustomErrorException;
use App\Helpers\Enum\Message;
use App\Helpers\Enum\QueryParam;
use App\Helpers\Validation;
use App\Models\Book;
use App\Models\Enums\StatusBook;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 09/02/2022
 */
class BookService extends BaseService implements IBookService
{
    protected IBaseRepository $entityRepository;
    protected IAuthorRepository $authorRepository;

    /**
     * @param IBookRepository $bookRepository
     * @param IAuthorRepository $authorRepository
     */
    public function __construct(IBookRepository $bookRepository, IAuthorRepository $authorRepository)
    {
        $this->entityRepository = $bookRepository;
        $this->authorRepository = $authorRepository;
    }

    /**
     * @throws CustomErrorException
     */
    public function findAllPortalPaginated(Request $request): LengthAwarePaginator
    {
        $filters = Validation::getFilters($request->get(QueryParam::FILTERS_KEY));
        $perPage = Validation::getPerPage($request->get(QueryParam::PAGINATION_KEY));
        $sort = $request->get(QueryParam::ORDER_BY_KEY);
        $authorsId = [];
        if (isset($filters['searchGeneral'])) {
            $authorsId = $this->authorRepository->findAllByName($filters['searchGeneral'])->pluck('id')->toArray();
        }
        return $this->entityRepository->findAllPortalPaginated($filters, $perPage, $authorsId, $sort,
                                                               ['id', 'title', 'status', 'image']);
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

    public function getMinMaxPages(): Book
    {
        return $this->entityRepository->getMinMaxPages();
    }
}
