<?php

namespace App\Models\Enum\CatalogoOpciones;

use App\Core\Traits\EnumToArray;

enum EstatusLibroEnum: int
{
    use EnumToArray;

    case DISPONIBLE = 1;
    case PRESTADO = 2;
    case PERDIDO = 3;

    static function customName(int $case): string
    {
        return match ($case) {
            self::DISPONIBLE->value => 'Disponible',
            self::PRESTADO->value => 'Prestado',
            self::PERDIDO->value => 'Perdido',
            default => '',
        };
    }

    public static function classCss(int $case): string|null
    {
        return match ($case) {
            self::DISPONIBLE->value => 'available-book',
            self::PRESTADO->value => 'loan-book',
            self::PERDIDO->value => 'lost-book',
            default => null,
        };
    }
}
