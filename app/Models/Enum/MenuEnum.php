<?php

namespace App\Models\Enum;

class MenuEnum
{
    const ADMIN = [
        [
            'path_ruta' => '/usuarios',
            'etiqueta' => 'Usuarios',
            'icono' => 'mat:group',
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
            'path_ruta' => '/autores',
            'etiqueta' => 'Autores',
            'icono' => 'mat:face',
            'orden' => 2,
            'rol_id' => RolEnum::ADMINISTRADOR->value,
            'submenus' => []
        ],
        [
            'path_ruta' => '/libros',
            'etiqueta' => 'Libros',
            'icono' => 'mat:library_books',
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
            'path_ruta' => '/donaciones',
            'etiqueta' => 'Donaciones',
            'icono' => 'mat:volunteer_activism',
            'orden' => 4,
            'rol_id' => RolEnum::ADMINISTRADOR->value,
            'submenus' => []
        ],
        [
            'path_ruta' => '/prestamos',
            'etiqueta' => 'Préstamos',
            'icono' => 'mat:published_with_changes',
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
            'path_ruta' => '/usuarios',
            'etiqueta' => 'Usuarios',
            'icono' => 'mat:group',
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
            'path_ruta' => '/autores',
            'etiqueta' => 'Autores',
            'icono' => 'mat:face',
            'orden' => 2,
            'rol_id' => RolEnum::CAPTURISTA->value,
            'submenus' => []
        ],
        [
            'path_ruta' => '/libros',
            'etiqueta' => 'Libros',
            'icono' => 'mat:library_books',
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
            'path_ruta' => '/donaciones',
            'etiqueta' => 'Donaciones',
            'icono' => 'mat:volunteer_activism',
            'orden' => 4,
            'rol_id' => RolEnum::CAPTURISTA->value,
            'submenus' => []
        ],
        [
            'path_ruta' => '/prestamos',
            'etiqueta' => 'Préstamos',
            'icono' => 'mat:published_with_changes',
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
            'path_ruta' => '/prestamos',
            'etiqueta' => 'Préstamos',
            'icono' => 'mat:published_with_changes',
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
            'path_ruta' => '/libros',
            'etiqueta' => 'Libros',
            'icono' => 'mat:library_books',
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
