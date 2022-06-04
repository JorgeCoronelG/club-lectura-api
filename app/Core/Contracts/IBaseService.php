<?php

namespace App\Core\Contracts;

/**
 * @author JorgeCoronelG
 * @version 1.0
 */
interface IBaseService
{
    public function create(\Spatie\DataTransferObject\DataTransferObject $dto): \Illuminate\Database\Eloquent\Model;

    public function delete(int $id): void;

    public function findAll(array $filter = [], string $sort = null, array $columns = ['*']):
        \Illuminate\Database\Eloquent\Collection;

    public function findAllPaginated(\Illuminate\Http\Request $request, array $columns = ['*']):
        \Illuminate\Pagination\LengthAwarePaginator;

    public function findById(int $id): \Illuminate\Database\Eloquent\Model;

    public function findRandom(): \Illuminate\Database\Eloquent\Model;

    public function findRandoms(int $records = 1): \Illuminate\Database\Eloquent\Collection;

    public function update(int $id, \Spatie\DataTransferObject\DataTransferObject $dto):
        \Illuminate\Database\Eloquent\Model;
}
