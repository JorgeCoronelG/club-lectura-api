<?php

namespace App\Core\Contracts;

/**
 * @author JorgeCoronelG
 * @version 1.0
 */
interface IBaseRepository
{
    public function create(array $data): \Illuminate\Database\Eloquent\Model;

    public function delete(int $id): void;

    public function findAll(array $filter = [], string $sort = null, array $columns = ['*']):
        \Illuminate\Database\Eloquent\Collection;

    public function findAllPaginated(array $filters, int $limit, string $sort = null, array $columns = ['*']):
        \Illuminate\Pagination\LengthAwarePaginator;

    public function findByField(string $field, mixed $value, string $operator = '=', array $columns = ['*']):
        \Illuminate\Database\Eloquent\Collection;

    public function findById(int $id): \Illuminate\Database\Eloquent\Model;

    public function findByMultipleConditions(array $where, array $columns = ['*']):
        \Illuminate\Database\Eloquent\Collection;

    public function findRandom(): \Illuminate\Database\Eloquent\Model;

    public function findRandoms(int $records = 1): \Illuminate\Database\Eloquent\Collection;

    public function findRecordsLatest(int $records = 10): \Illuminate\Database\Eloquent\Collection;

    public function findOneWithCondition(string $field, mixed $value, string $operator = '='):
        \Illuminate\Database\Eloquent\Model;

    public function findWhereIn(string $field, array $values, array $columns = ['*']):
        \Illuminate\Database\Eloquent\Collection;

    public function findWhereNotIn(string $field, array $values, array $columns = ['*']):
    \Illuminate\Database\Eloquent\Collection;

    public function has(string $relation): IBaseRepository;

    public function hidden(array $fields): IBaseRepository;

    public function orderBy(string $column, string $direction = 'ASC'): IBaseRepository;

    public function sync(int $id, string $relation, array $attributes, bool $detaching = true): array;

    public function update(int $id, array $data): \Illuminate\Database\Eloquent\Model;

    public function visible(array $fields): IBaseRepository;

    public function whereHas(string $relation, \Closure $closure): IBaseRepository;

    public function with(array|string $relations): IBaseRepository;

    public function withCount(array|string $relations): IBaseRepository;
}
