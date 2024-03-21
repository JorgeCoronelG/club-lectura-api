<?php

namespace App\Models\Enum\CatalogoOpciones;

use App\Core\Traits\EnumToArray;

enum SexoUsuarioEnum: int
{
    use EnumToArray;

    case HOMBRE = 1;
    case MUJER = 2;

    static function customName(int $case): string
    {
        return match ($case) {
            self::HOMBRE->value => 'Hombre',
            self::MUJER->value => 'Mujer',
            default => '',
        };
    }

    public static function classCss(int $case): string|null
    {
        return match ($case) {
            self::HOMBRE->value => 'man',
            self::MUJER->value => 'woman',
            default => null,
        };
    }
}
