<?php

namespace Database\Seeders;

use App\Models\Enum\MenuEnum;
use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ([MenuEnum::ADMIN, MenuEnum::CAPTURISTA, MenuEnum::LECTOR] as $tipoMenu) {
            foreach ($tipoMenu as $menu) {
                $menuId = Menu::query()->create([
                    'path_ruta' => $menu['path_ruta'],
                    'etiqueta' => $menu['etiqueta'],
                    'icono' => $menu['icono'],
                    'orden' => $menu['orden'],
                    'rol_id' => $menu['rol_id']
                ])
                    ->id;

                if (count($menu['submenus']) === 0) {
                    continue;
                }

                $submenus = [];
                foreach ($menu['submenus'] as $submenu) {
                    $submenus[] = array_merge($submenu, [
                        'menu_id' => $menuId
                    ]);
                }

                Submenu::query()->insert($submenus);
            }
        }
    }
}
