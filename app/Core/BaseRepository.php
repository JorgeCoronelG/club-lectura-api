<?php

namespace App\Core;

use App\Core\Contracts\IBaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Throwable;

/**
 * @author JorgeCoronelG
 * @version 1.0
 */
class BaseRepository implements IBaseRepository
{
    protected Builder|Model $entity;

    /**
     * @throws Throwable
     */
    public function create(array $data): Model
    {
        $entity = $this->entity->newInstance($data);
        $entity->saveOrFail();
        return $entity;
    }

    /**
     * @throws Throwable
     */
    public function delete(int $id): void
    {
        $entity = $this->findById($id);
        $entity->deleteOrFail();
    }

    /**
     * @throws Throwable
     */
    public function findAll(array $filter = [], string $sort = null, array $columns = ['*']): Collection
    {
        return $this->entity
            ->filter($filter)
            ->applySort($sort)
            ->get($columns);
    }

    /**
     * @throws Throwable
     */
    public function findAllPaginated(array $filters, int $limit, string $sort = null, array $columns = ['*']):
        LengthAwarePaginator
    {
        return $this->entity
            ->filter($filters)
            ->applySort($sort)
            ->paginate($limit, $columns);
    }

    /**
     * @throws Throwable
     */
    public function findById(int $id): Model
    {
        return $this->entity->findOrFail($id);
    }

    public function findRandom(): Model
    {
        return $this->entity->inRandomOrder()->limit(1)->first();
    }

    public function findRandoms(int $records = 1): Collection
    {
        return $this->entity->inRandomOrder()->limit($records)->get();
    }

    public function sync(int $id, string $relation, array $attributes, bool $detaching = true): array
    {
        return $this->findById($id)->{$relation}()->sync($attributes, $detaching);
    }

    /**
     * @throws Throwable
     */
    public function update(int $id, array $data): Model
    {
        $entity = $this->findById($id);
        $entity->fill($data);
        $entity->saveOrFail();
        return $entity;
    }
}
