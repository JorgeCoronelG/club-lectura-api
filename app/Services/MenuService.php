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

    public function createDefaultMenu(Usuario $user): void
    {
        $menus = $this->entityRepository
            ->findAllByRolId($user->rol_id)
            ->pluck('id')
            ->toArray();
        $submenus = $this->submenuRepository
            ->findAllByRolId($user->rol_id)
            ->pluck('id')
            ->toArray();

        $user->menus()->attach($menus);
        $user->submenus()->attach($submenus);
    }

    public function changeMenuByRol(Usuario $user): void
    {
        $user->menus()->detach();
        $user->submenus()->detach();

        $this->createDefaultMenu($user);
    }

    public function hasPermissionToUrl(int $userId, string $pathUrl): bool
    {
        $paths = $this->entityRepository->getPathRouteNavigationByUserId($userId);
        return $paths->where('path_ruta', '=', $pathUrl)->count() > 0;
    }
}
