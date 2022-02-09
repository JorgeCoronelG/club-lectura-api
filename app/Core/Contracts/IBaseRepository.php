<?php

namespace App\Core\Contracts;

/**
 * @author JorgeCoronelG
 * @version 1.0
 */
interface IBaseRepository
{
    public function findAll(): \Illuminate\Database\Eloquent\Collection;

    public function findAllPaginated(array $filters, int $paginated, string $sort = null): \Illuminate\Pagination\LengthAwarePaginator;

    public function findById(int $id): \Illuminate\Database\Eloquent\Model;

    public function create(array $data): \Illuminate\Database\Eloquent\Model;

    public function update(array $data, \Illuminate\Database\Eloquent\Model $entity): \Illuminate\Database\Eloquent\Model;

    public function delete(\Illuminate\Database\Eloquent\Model $entity): void;

    public function findRandom(): \Illuminate\Database\Eloquent\Model;

    public function findRandoms(int $records = 1): \Illuminate\Database\Eloquent\Collection;

    public function findRecordsLatest(int $record = 10): \Illuminate\Database\Eloquent\Collection;
}
