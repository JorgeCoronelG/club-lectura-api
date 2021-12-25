<?php

namespace App\Core;

use App\Core\Contracts\IBaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @author JorgeCoronelG
 * @version 1.0
 */
class BaseRepository implements IBaseRepository
{
    protected Model $entity;

    /**
     * @throws \Throwable
     */
    public function findAll(): Collection
    {
        if (func_num_args() === 0) {
            return $this->entity->all();
        }

        $args = func_get_args();

        return $this->entity
            ->filter($args[0])
            ->applySort($args[1])
            ->get();
    }

    /**
     * @throws \Throwable
     */
    public function findAllPaginated(array $filters, int $paginated, string $sort = null): LengthAwarePaginator
    {
        return $this->entity
            ->filter($filters)
            ->applySort($sort)
            ->paginate($paginated);
    }

    public function findById(int $id): Model
    {
        return $this->entity->findOrFail($id);
    }

    /**
     * @throws \Throwable
     */
    public function create(array $data): Model
    {
        $entity = $this->entity->newInstance($data);
        $entity->saveOrFail();
        return $entity;
    }

    /**
     * @throws \Throwable
     */
    public function update(array $data, Model $entity): Model
    {
        $entity->fill($data);
        $entity->saveOrFail();
        return $entity;
    }

    /**
     * @throws \Exception
     */
    public function delete(Model $entity): void
    {
        $entity->delete();
    }
}
