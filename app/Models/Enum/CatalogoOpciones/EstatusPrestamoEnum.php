<?php

namespace App\Models\Enum\CatalogoOpciones;

use App\Core\Traits\EnumToArray;

enum EstatusPrestamoEnum: int
{
    use EnumToArray;

    case PRESTAMO = 1;
    case ENTREGADO = 2;
    case PERDIDO = 3;

    public static function customName(int $case): string
    {
        return match ($case) {
            self::PRESTAMO->value => 'Préstamo',
            self::ENTREGADO->value => 'Entregado',
            self::PERDIDO->value => 'Perdido',
            default => ''
        };
    }

    public static function classCss(int $case): string|null
    {
        return match ($case) {
            self::PRESTAMO->value => 'on-loan',
            self::ENTREGADO->value => 'off-loan',
            self::PERDIDO->value => 'on-lost',
            default => null
        };
    }
}
