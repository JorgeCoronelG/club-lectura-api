<?php

namespace App\Services;

use App\Contracts\Repositories\MenuRepositoryInterface;
use App\Contracts\Repositories\SubmenuRepositoryInterface;
use App\Contracts\Services\MenuServiceInterface;
use App\Core\BaseService;
use App\Core\Contracts\BaseRepositoryInterface;
use App\Models\Usuario;

class MenuService extends BaseService implements MenuServiceInterface
{
    protected BaseRepositoryInterface $entityRepository;
    protected SubmenuRepositoryInterface $submenuRepository;

    public function __construct(
        MenuRepositoryInterface $menuRepository,
        SubmenuRepositoryInterface $submenuRepository,
    ) {
        $this->entityRepository = $menuRepository;
        $this->submenuRepository = $submenuRepository;
    }

    public function crearMenuPorDefecto(Usuario $usuario): void
    {
        $menus = $this->entityRepository
            ->obtenerTodosPorRolId($usuario->rol_id)
            ->pluck('id')
            ->toArray();
        $submenus = $this->submenuRepository
            ->obtenerTodosPorRolId($usuario->rol_id)
            ->pluck('id')
            ->toArray();

        $usuario->menus()->attach($menus);
        $usuario->submenus()->attach($submenus);
    }
}
