<?php

namespace App\Models\Enum;

use App\Core\Traits\EnumToArray;

enum CatalogoEnum: int
{
    use EnumToArray;

    case ESTATUS_USUARIO = 1;
    case SEXO = 2;
    case TIPO_ESCOLAR = 3;
    case TURNO_ALUMNO = 4;
}
