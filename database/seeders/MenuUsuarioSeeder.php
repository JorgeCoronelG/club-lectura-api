<?php

namespace Database\Seeders;

use App\Models\Enum\RolEnum;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class MenuUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ([RolEnum::ADMINISTRADOR->value, RolEnum::CAPTURISTA->value, RolEnum::LECTOR->value] as $rolId) {
            $menus = $this->obtenerMenusPorRol($rolId);
            $submenus = $this->obtenerSubmenusPorRol($rolId);
            $this->attachMenuSubmenu($rolId, $menus, $submenus);
        }
    }

    private function attachMenuSubmenu(int $rolId, array $menus, array $submenus): void
    {
        Usuario::query()
            ->where('rol_id', $rolId)
            ->get()
            ->each(function (Usuario $usuario) use ($menus, $submenus) {
                $usuario->menus()->attach($menus);
                $usuario->submenus()->attach($submenus);
            });
    }

    private function obtenerMenusPorRol(int $rolId): array
    {
        return Menu::query()
            ->where('rol_id', $rolId)
            ->pluck('id')
            ->toArray();
    }

    private function obtenerSubmenusPorRol(int $rolId): array
    {
        return Submenu::query()
            ->join('menus', 'menus.id', '=', 'submenus.menu_id')
            ->where('menus.rol_id', $rolId)
            ->select(['submenus.id'])
            ->pluck('id')
            ->toArray();
    }
}
