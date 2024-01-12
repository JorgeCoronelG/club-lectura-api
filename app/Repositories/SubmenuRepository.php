<?php

namespace App\Repositories;

use App\Contracts\Repositories\SubmenuRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\Submenu;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class SubmenuRepository extends BaseRepository implements SubmenuRepositoryInterface
{
    protected Builder|Model|QueryBuilder $entity;

    public function __construct(Submenu $submenu)
    {
        $this->entity = $submenu;
    }

    public function findAllByRolId(int $rolId): Collection
    {
        return $this->entity
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            ->where('menus.rol_id', $rolId)
            ->where('submenus.estatus', true)
            ->orderBy('submenus.orden')
            ->get(['submenus.*']);
    }

    public function findByUserId(int $userId): Collection
    {
        return $this->entity
            ->select(['submenus.*'])
            ->join('submenu_usuarios', 'submenus.id', '=', 'submenu_usuarios.submenu_id')
            ->where('submenu_usuarios.usuario_id', $userId)
            ->where('estatus', true)
            ->orderBy('orden')
            ->get();
    }
}
