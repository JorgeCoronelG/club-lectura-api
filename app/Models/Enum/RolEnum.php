<?php

namespace App\Models\Enum;

use App\Core\Traits\EnumToArray;

enum RolEnum: int
{
    use EnumToArray;

    case ADMINISTRADOR = 1;
    case CAPTURISTA = 2;
    case LECTOR = 3;
}
