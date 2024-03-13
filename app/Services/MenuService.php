<?php

namespace App\Services;

use App\Contracts\Repositories\MenuRepositoryInterface;
use App\Contracts\Repositories\SubmenuRepositoryInterface;
use App\Contracts\Repositories\UsuarioRepositoryInterface;
use App\Contracts\Services\MenuServiceInterface;
use App\Core\BaseService;
use App\Core\Contracts\BaseRepositoryInterface;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;

class MenuService extends BaseService implements MenuServiceInterface
{
    protected BaseRepositoryInterface $entityRepository;
    protected SubmenuRepositoryInterface $submenuRepository;
    protected UsuarioRepositoryInterface $usuarioRepository;

    public function __construct(
        MenuRepositoryInterface $menuRepository,
        SubmenuRepositoryInterface $submenuRepository,
        UsuarioRepositoryInterface $usuarioRepository,
    ) {
        $this->entityRepository = $menuRepository;
        $this->submenuRepository = $submenuRepository;
        $this->usuarioRepository = $usuarioRepository;
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

    public function getNavigationMenu(int $userId): \Illuminate\Support\Collection
    {
        $menus = $this->entityRepository->findByUserId($userId);
        $submenus = $this->submenuRepository->findByUserId($userId);

        return $this->convertNavigationMenu($menus, $submenus);
    }

    private function convertNavigationMenu(Collection $menus, Collection $submenus): \Illuminate\Support\Collection
    {
        return $menus->map(function (Menu $menu) use ($submenus) {
            $submenusArr = $submenus
                ->filter(function (Submenu $submenu) use ($menu) {
                    return $submenu->menu_id === $menu->id;
                })
                ->map(function (Submenu $submenu) use ($menu) {
                    $submenu['path_ruta'] = $menu['path_ruta'].$submenu['path_ruta'];
                    return $submenu;
                })
                ->values();

            return collect($menu)->put('submenu', $submenusArr);
        });
    }

    public function getNavigationByUserId(int $userId): \Illuminate\Support\Collection
    {
        $user = $this->usuarioRepository->findById($userId);

        $menus = $this->entityRepository->findAllByRolId($user->rol_id);
        $menusUser = $this->entityRepository->findByUserId($userId);
        $submenus = $this->submenuRepository->findAllByRolId($user->rol_id);
        $submenusUser = $this->submenuRepository->findByUserId($userId);

        return $menus->map(function (Menu $menu) use ($submenus, $menusUser, $submenusUser) {
            $submenusArr = $submenus
                ->filter(function (Submenu $submenu) use ($menu) {
                    return $submenu->menu_id === $menu->id;
                })
                ->map(function (Submenu $submenu) use ($submenusUser) {
                    $submenu['is_selected'] = $submenusUser->where('id', '=', $submenu->id)->count() === 1;
                    return $submenu;
                })
                ->values();

            $menu['is_selected'] = $menusUser->where('id', '=', $menu->id)->count() === 1;
            return collect($menu)->put('submenu', $submenusArr);
        });
    }

    public function syncNavigation(int $userId, array $menuIds, array $submenuIds): void
    {
        $this->usuarioRepository->sync($userId, 'menus', $menuIds);
        $this->usuarioRepository->sync($userId, 'submenus', $submenuIds);

        $user = $this->usuarioRepository->findById($userId);
        $user->tokens()->each(function ($token) {
            $token->delete();
        });
    }
}
