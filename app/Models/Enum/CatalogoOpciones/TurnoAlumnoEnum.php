<?php

namespace App\Models\Enum\CatalogoOpciones;

use App\Core\Traits\EnumToArray;

enum TurnoAlumnoEnum: int
{
    use EnumToArray;

    case MATUTINO = 1;
    case VESPERTINO = 2;

    static function customName(int $case): string
    {
        return match ($case) {
            self::MATUTINO->value => 'Matutino',
            self::VESPERTINO->value => 'Vespertino',
            default => '',
        };
    }
}
