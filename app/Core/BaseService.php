<?php

namespace App\Core;

use App\Core\Contracts\IBaseRepository;
use App\Core\Contracts\IBaseService;
use App\Helpers\Enum\QueryParam;
use App\Helpers\Validation;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * @author JorgeCoronelG
 * @version 1.0
 */
class BaseService implements IBaseService
{
    protected IBaseRepository $entityRepository;

    public function create(DataTransferObject $dto): Model
    {
        return $this->entityRepository->create($dto->toArray());
    }

    public function delete(int $id): void
    {
        $this->entityRepository->delete($id);
    }

    public function findAll(array $filter = [], string $sort = null, array $columns = ['*']): Collection
    {
        return $this->entityRepository->findAll($filter, $sort, $columns);
    }

    /**
     * @throws Exception
     */
    public function findAllPaginated(Request $request, array $columns = ['*']): LengthAwarePaginator
    {
        $filters = Validation::getFilters($request->get(QueryParam::FILTERS_KEY));
        $perPage = Validation::getPerPage($request->get(QueryParam::PAGINATION_KEY));
        $sort = $request->get(QueryParam::ORDER_BY_KEY);
        return $this->entityRepository->findAllPaginated($filters, $perPage, $sort, $columns);
    }

    public function findById(int $id): Model
    {
        return $this->entityRepository->findById($id);
    }

    public function findRandom(): Model
    {
        return $this->entityRepository->findRandom();
    }

    public function findRandoms(int $records = 1): Collection
    {
        return $this->entityRepository->findRandoms($records);
    }

    public function update(int $id, DataTransferObject $dto): Model
    {
        return $this->entityRepository->update($id, $dto->toArray());
    }
}
