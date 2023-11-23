<?php

namespace App\Models\Enum;

class MenuEnum
{
    const ADMIN = [
        [
            'path_ruta' => '/dashboard/usuarios',
            'etiqueta' => 'Usuarios',
            'icono' => 'N/A',
            'orden' => 1,
            'rol_id' => RolEnum::ADMINISTRADOR->value,
            'submenus' => [
                [
                    'path_ruta' => '/gestion',
                    'etiqueta' => 'Gestión',
                    'orden' => 1,
                ],
                [
                    'path_ruta' => '/permisos',
                    'etiqueta' => 'Permisos',
                    'orden' => 2,
                ],
            ]
        ],
        [
            'path_ruta' => '/dashboard/autores',
            'etiqueta' => 'Autores',
            'icono' => 'N/A',
            'orden' => 2,
            'rol_id' => RolEnum::ADMINISTRADOR->value,
            'submenus' => []
        ],
        [
            'path_ruta' => '/dashboard/libros',
            'etiqueta' => 'Libros',
            'icono' => 'N/A',
            'orden' => 3,
            'rol_id' => RolEnum::ADMINISTRADOR->value,
            'submenus' => [
                [
                    'path_ruta' => '/gestion',
                    'etiqueta' => 'Gestión',
                    'orden' => 1,
                ],
            ]
        ],
        [
            'path_ruta' => '/dashboard/donaciones',
            'etiqueta' => 'Donaciones',
            'icono' => 'N/A',
            'orden' => 4,
            'rol_id' => RolEnum::ADMINISTRADOR->value,
            'submenus' => []
        ],
        [
            'path_ruta' => '/dashboard/prestamos',
            'etiqueta' => 'Préstamos',
            'icono' => 'N/A',
            'orden' => 5,
            'rol_id' => RolEnum::ADMINISTRADOR->value,
            'submenus' => [
                [
                    'path_ruta' => '/gestion',
                    'etiqueta' => 'Gestión',
                    'orden' => 1,
                ],
            ]
        ]
    ];

    const CAPTURISTA = [
        [
            'path_ruta' => '/dashboard/usuarios',
            'etiqueta' => 'Usuarios',
            'icono' => 'N/A',
            'orden' => 1,
            'rol_id' => RolEnum::CAPTURISTA->value,
            'submenus' => [
                [
                    'path_ruta' => '/gestion',
                    'etiqueta' => 'Gestión',
                    'orden' => 1,
                ],
            ]
        ],
        [
            'path_ruta' => '/dashboard/autores',
            'etiqueta' => 'Autores',
            'icono' => 'N/A',
            'orden' => 2,
            'rol_id' => RolEnum::CAPTURISTA->value,
            'submenus' => []
        ],
        [
            'path_ruta' => '/dashboard/libros',
            'etiqueta' => 'Libros',
            'icono' => 'N/A',
            'orden' => 3,
            'rol_id' => RolEnum::CAPTURISTA->value,
            'submenus' => [
                [
                    'path_ruta' => '/gestion',
                    'etiqueta' => 'Gestión',
                    'orden' => 1,
                ],
            ]
        ],
        [
            'path_ruta' => '/dashboard/donaciones',
            'etiqueta' => 'Donaciones',
            'icono' => 'N/A',
            'orden' => 4,
            'rol_id' => RolEnum::CAPTURISTA->value,
            'submenus' => []
        ],
        [
            'path_ruta' => '/dashboard/prestamos',
            'etiqueta' => 'Préstamos',
            'icono' => 'N/A',
            'orden' => 5,
            'rol_id' => RolEnum::CAPTURISTA->value,
            'submenus' => [
                [
                    'path_ruta' => '/gestion',
                    'etiqueta' => 'Gestión',
                    'orden' => 1,
                ],
            ]
        ]
    ];

    const LECTOR = [
        [
            'path_ruta' => '/dashboard/prestamos',
            'etiqueta' => 'Préstamos',
            'icono' => 'N/A',
            'orden' => 1,
            'rol_id' => RolEnum::LECTOR->value,
            'submenus' => [
                [
                    'path_ruta' => '/mis-prestamos',
                    'etiqueta' => 'Mis préstamos',
                    'orden' => 1,
                ],
            ]
        ],
        [
            'path_ruta' => '/dashboard/libros',
            'etiqueta' => 'Libros',
            'icono' => 'N/A',
            'orden' => 2,
            'rol_id' => RolEnum::LECTOR->value,
            'submenus' => [
                [
                    'path_ruta' => '/biblioteca',
                    'etiqueta' => 'Biblioteca',
                    'orden' => 1,
                ],
            ]
        ]
    ];
}
