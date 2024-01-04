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

    public function findAllByRolId(int $rolId): Collection
    {
        return $this->entity
            ->where('rol_id', $rolId)
            ->where('estatus', true)
            ->orderBy('orden')
            ->get();
    }

    public function getPathRouteNavigationByUserId(int $userId): Collection
    {
        $submenusQuery = $this->entity
            ->selectRaw('CONCAT(m.path_ruta, s.path_ruta) AS path_ruta')
            ->from('submenus AS s')
            ->join('menus AS m', 's.menu_id', '=', 'm.id')
            ->join('submenu_usuarios AS su', 'su.submenu_id', '=', 's.id')
            ->where('usuario_id', $userId);

        return $this->entity
            ->select(['m.path_ruta'])
            ->from('menus AS m')
            ->leftJoin('submenus AS s','s.menu_id', '=', 'm.id')
            ->join('menu_usuario AS mu', 'mu.menu_id', '=', 'm.id')
            ->whereNull('s.id')
            ->where('mu.usuario_id', $userId)
            ->unionAll($submenusQuery)
            ->get();
    }
}
