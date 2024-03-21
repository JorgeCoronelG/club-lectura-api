<?php

namespace App\Models\Enum\CatalogoOpciones;

use App\Core\Traits\EnumToArray;

enum EstadoFisicoLibroEnum: int
{
    use EnumToArray;

    case BUENO = 1;
    case MALO = 2;
    CASE REGULAR = 3;

    static function customName(int $case): string
    {
        return match ($case) {
            self::BUENO->value => 'Bueno',
            self::MALO->value => 'Malo',
            self::REGULAR->value => 'Regular',
            default => '',
        };
    }

    public static function classCss(int $case): string|null
    {
        return match ($case) {
            self::BUENO->value => 'good-condition',
            self::MALO->value => 'bad-condition',
            self::REGULAR->value => 'regular-condition',
            default => null,
        };
    }
}
