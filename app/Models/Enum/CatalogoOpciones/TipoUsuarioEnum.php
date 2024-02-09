<?php

namespace App\Models\Enum\CatalogoOpciones;

use App\Core\Traits\EnumToArray;

enum TipoUsuarioEnum: int
{
    use EnumToArray;

    CASE ESCOLAR = 1;

    CASE ALUMNO = 2;

    CASE EXTERNO = 3;
}
