<?php

namespace App\Models\Enum\CatalogoOpciones;

use App\Core\Traits\EnumToArray;

enum EstatusUsuarioEnum: int
{
    use EnumToArray;

    case ACTIVO = 1;
    case INACTIVO = 2;
}
