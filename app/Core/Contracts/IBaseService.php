<?php

namespace App\Core\Contracts;

/**
 * @author JorgeCoronelG
 * @version 1.0
 */
interface IBaseService
{
    public function findAll(): \Illuminate\Database\Eloquent\Collection;

    public function findAllPaginated(\Illuminate\Http\Request $request): \Illuminate\Pagination\LengthAwarePaginator;

    public function findById(int $id): \Illuminate\Database\Eloquent\Model;

    public function create(\Spatie\DataTransferObject\DataTransferObject $dto): \Illuminate\Database\Eloquent\Model;

    public function update(\Spatie\DataTransferObject\DataTransferObject $dto, \Illuminate\Database\Eloquent\Model $entity): \Illuminate\Database\Eloquent\Model;

    public function delete(\Illuminate\Database\Eloquent\Model $entity): void;

    public function findRandom(): \Illuminate\Database\Eloquent\Model;

    public function findRandoms(int $records = 1): \Illuminate\Database\Eloquent\Collection;

    public function findRecordsLatest(int $records = 10): \Illuminate\Database\Eloquent\Collection;
}
