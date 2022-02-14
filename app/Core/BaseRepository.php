<?php

namespace App\Core;

use App\Core\Contracts\IBaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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

    public function findByField(string $field, mixed $value, string $operator = '=', array $columns = ['*']): Collection
    {
        return $this->entity->where($field, $operator, $value)->get($columns);
    }

    /**
     * @param array $where
     * Especificación del array $where
     * Estructura: array('campo' => ['valor_a_buscar', 'operador'], 'campo' => ['valor_a_buscar'])
     * Ejemplo:
     * array('nombre' => ['Jorge', '!='], 'email' => ['tprog'])
     * Si el arreglo secundario contiene un valor, sería el valor a buscar y el operador por defecto sería '='
     * Si el arreglo secundario contiene 2 valores, el primero será el valor a buscar y el segundo el operador de la búsqueda
     * @param array $columns
     * @return Collection
     */
    public function findByMultipleConditions(array $where, array $columns = ['*']): Collection
    {
        $this->applyConditions($where);
        return $this->entity->get($columns);
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
    public function findOneWithCondition(string $field, mixed $value, string $operator = '=' ): Model
    {
        return $this->entity->where($field, $operator, $value)->firstOrFail();
    }

    public function findWhereIn(string $field, array $values, array $columns = ['*']): Collection {
        return $this->entity->whereIn($field, $values)->get($columns);
    }

    public function findWhereNotIn(string $field, array $values, array $columns = ['*']): Collection {
        return $this->entity->whereNotIn($field, $values)->get($columns);
    }

    public function has(string $relation): BaseRepository
    {
        $this->entity = $this->entity->has($relation);
        return $this;
    }

    public function hidden(array $fields): BaseRepository
    {
        $this->entity->setHidden($fields);
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): BaseRepository
    {
        $this->entity = $this->entity->orderBy($column, $direction);
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

    public function visible(array $fields): BaseRepository
    {
        $this->entity->setVisible($fields);
        return $this;
    }

    private function applyConditions(array $where): void
    {
        foreach ($where as $field => $value) {
            if (count($value) === 1) {
                list($value) = $value;
                $this->entity = $this->entity->where($field, '=', $value);
            } else if (count($value) === 2) {
                list($value, $operator) = $value;
                $this->entity = $this->entity->where($field, $operator, $value);
            }
        }
    }

    public function whereHas(string $relation, \Closure $closure): \App\Core\BaseRepository
    {
        $this->entity = $this->entity->whereHas($relation, $closure);
        return $this;
    }

    public function with(array|string $relations): BaseRepository
    {
        $this->entity = $this->entity->with($relations);
        return $this;
    }

    public function withCount(array|string $relations): BaseRepository
    {
        $this->entity = $this->entity->withCount($relations);
        return $this;
    }
}
