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

    public function __construct(IBaseRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    public function findAll(): Collection
    {
        if (func_num_args() === 2) {
            $args = func_get_args();
            return $this->entityRepository->findAll($args[0], $args[1]);
        }
        return $this->entityRepository->findAll();
    }

    /**
     * @throws Exception
     */
    public function findAllPaginated(Request $request): LengthAwarePaginator
    {
        $filters = Validation::getFilters($request->get(QueryParam::FILTERS_KEY));
        $perPage = Validation::getPerPage($request->get(QueryParam::PAGINATION_KEY));
        $sort = $request->get(QueryParam::ORDER_BY_KEY);
        return $this->entityRepository->findAllPaginated($filters, $perPage, $sort);
    }

    public function findById(int $id): Model
    {
        return $this->entityRepository->findById($id);
    }

    public function create(DataTransferObject $dto): Model
    {
        return $this->entityRepository->create($dto->toArray());
    }

    public function update(DataTransferObject $dto, Model $entity): Model
    {
        return $this->entityRepository->update($dto->toArray(), $entity);
    }

    public function delete(Model $entity): void
    {
        $this->entityRepository->delete($entity);
    }

    public function findRandom(): Model
    {
        return $this->entityRepository->findRandom();
    }

    public function findRandoms(int $records = 1): Collection
    {
        return $this->entityRepository->findRandoms($records);
    }
}
