<?php

namespace App\Models\Enum\CatalogoOpciones;

use App\Core\Traits\EnumToArray;

enum TurnoAlumnoEnum: int
{
    use EnumToArray;

    case MATUTINO = 1;
    case VESPERTINO = 2;
}
