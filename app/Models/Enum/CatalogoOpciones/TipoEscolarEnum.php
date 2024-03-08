<?php

namespace App\Models\Enum\CatalogoOpciones;

use App\Core\Traits\EnumToArray;

enum TipoEscolarEnum: int
{
    use EnumToArray;

    case DOCENTE = 1;
    case ADMINISTRATIVO = 2;
    case OPERATIVO = 3;

    static function customName(int $case): string
    {
        return match ($case) {
            self::DOCENTE->value => 'Docente',
            self::ADMINISTRATIVO->value => 'Administrativo',
            self::OPERATIVO->value => 'Operativo',
            default => '',
        };
    }
}
