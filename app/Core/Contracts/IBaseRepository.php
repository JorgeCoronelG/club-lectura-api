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

    public function findById(int $id): \Illuminate\Database\Eloquent\Model;

    public function findRandom(): \Illuminate\Database\Eloquent\Model;

    public function findRandoms(int $records = 1): \Illuminate\Database\Eloquent\Collection;

    public function findRecordsLatest(int $records = 10): \Illuminate\Database\Eloquent\Collection;

    public function firstOrFail(): \Illuminate\Database\Eloquent\Model;

    public function get(array $columns = ['*']): \Illuminate\Database\Eloquent\Collection;

    public function has(string $relation): IBaseRepository;

    public function hidden(array $columns): IBaseRepository;

    public function latest(): IBaseRepository;

    public function limit($records = 10): IBaseRepository;

    public function oldest($column = null): IBaseRepository;

    public function orderBy(string $column, string $direction = 'ASC'): IBaseRepository;

    public function select(mixed $columns): IBaseRepository;

    public function sync(int $id, string $relation, array $attributes, bool $detaching = true): array;

    public function update(int $id, array $data): \Illuminate\Database\Eloquent\Model;

    public function visible(array $columns): IBaseRepository;

    public function where(string $column, mixed $value, string $operator = '='): IBaseRepository;

    public function whereIn(string $column, array $values): IBaseRepository;

    public function whereNotIn(string $column, array $values): IBaseRepository;

    public function whereHas(string $relation, \Closure $closure): IBaseRepository;

    public function with(array|string $relations): IBaseRepository;

    public function withCount(array|string $relations): IBaseRepository;
}
