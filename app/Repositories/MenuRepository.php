<?php

namespace App\Repositories;

use App\Contracts\Repositories\MenuRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{
    protected Builder|Model|QueryBuilder $entity;

    public function __construct(Menu $menu)
    {
        $this->entity = $menu;
    }

    public function obtenerTodosPorRolId(int $rolId): Collection
    {
        return $this->entity
            ->where('rol_id', $rolId)
            ->where('estatus', true)
            ->orderBy('orden')
            ->get();
    }
}
