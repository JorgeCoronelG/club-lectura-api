<?php

namespace App\Models\Enum\CatalogoOpciones;

use App\Core\Traits\EnumToArray;

enum SexoUsuarioEnum: int
{
    use EnumToArray;

    case HOMBRE = 1;
    case MUJER = 2;
}
