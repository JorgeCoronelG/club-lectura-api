<?php

namespace App\Models\Enum\CatalogoOpciones;

use App\Core\Traits\EnumToArray;

enum TipoEscolarEnum: int
{
    use EnumToArray;

    case DOCENTE = 1;
    case ADMINISTRATIVO = 2;
    case OPERATIVO = 3;
}
