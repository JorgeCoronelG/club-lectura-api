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

    public function findRecordsLatest(int $records = 10): Collection
    {
        return $this->entity->latest()->limit($records)->get();
    }

    /**
     * @throws Throwable
     */
    public function firstOrFail(): Model
    {
        return $this->entity->firstOrFail();
    }

    public function get(array $columns = ['*']): Collection
    {
        return $this->entity->get($columns);
    }

    public function has(string $relation): IBaseRepository
    {
        $this->entity = $this->entity->has($relation);
        return $this;
    }

    public function hidden(array $columns): IBaseRepository
    {
        $this->entity->setHidden($columns);
        return $this;
    }

    public function latest(string $column = null): IBaseRepository
    {
        $this->entity = $this->entity->latest($column);
        return $this;
    }

    public function limit($records = 10): IBaseRepository
    {
        $this->entity = $this->entity->limit($records);
        return $this;
    }

    public function oldest($column = null): IBaseRepository
    {
        $this->entity = $this->entity->oldest($column);
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): IBaseRepository
    {
        $this->entity = $this->entity->orderBy($column, $direction);
        return $this;
    }

    public function select(mixed $columns): IBaseRepository
    {
        $this->entity = $this->entity->select($columns);
        return $this;
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

    public function visible(array $columns): IBaseRepository
    {
        $this->entity->setVisible($columns);
        return $this;
    }

    public function where(string $column, mixed $value, string $operator = '='): IBaseRepository
    {
        $this->entity = $this->entity->where($column, $operator, $value);
        return $this;
    }

    public function whereIn(string $column, array $values): IBaseRepository
    {
        $this->entity = $this->entity->whereIn($column, $values);
        return $this;
    }

    public function whereNotIn(string $column, array $values): IBaseRepository
    {
        $this->entity = $this->entity->whereNotIn($column, $values);
        return $this;
    }

    public function whereHas(string $relation, \Closure $closure): IBaseRepository
    {
        $this->entity = $this->entity->whereHas($relation, $closure);
        return $this;
    }

    public function with(array|string $relations): IBaseRepository
    {
        $this->entity = $this->entity->with($relations);
        return $this;
    }

    public function withCount(array|string $relations): IBaseRepository
    {
        $this->entity = $this->entity->withCount($relations);
        return $this;
    }
}
