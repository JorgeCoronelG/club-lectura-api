<?php

namespace App\Core\Contracts;

interface BaseRepositoryInterface
{
    public function create(array $data): \Illuminate\Database\Eloquent\Model;

    public function bulkInsert(array $data): bool;

    public function delete(int $id): void;

    public function bulkDelete(array $ids, string $primaryKey = 'id'): bool;

    public function findAll(array $filter = [], string $sort = null, array $columns = ['*']):
    \Illuminate\Database\Eloquent\Collection;

    public function findAllPaginated(array $filters, int $limit, string $sort = null, array $columns = ['*']):
    \Illuminate\Pagination\LengthAwarePaginator;

    public function findById(int $id, array $columns = ['*']): \Illuminate\Database\Eloquent\Model;

    public function findRandom(): \Illuminate\Database\Eloquent\Model;

    public function findRandoms(int $records = 1): \Illuminate\Database\Eloquent\Collection;

    public function sync(int $id, string $relation, array $attributes, bool $detaching = true): array;

    public function update(int $id, array $data): \Illuminate\Database\Eloquent\Model;

    public function bulkUpdate(array $ids, array $data, string $primaryKey = 'id'): int;
}
