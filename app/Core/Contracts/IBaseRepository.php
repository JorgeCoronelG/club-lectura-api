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

    public function sync(int $id, string $relation, array $attributes, bool $detaching = true): array;

    public function update(int $id, array $data): \Illuminate\Database\Eloquent\Model;
}
