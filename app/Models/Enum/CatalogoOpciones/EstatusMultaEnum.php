<?php

namespace App\Models\Enum\CatalogoOpciones;

use App\Core\Traits\EnumToArray;

enum EstatusMultaEnum: int
{
    use EnumToArray;

    case PENDIENTE = 1;
    case PAGADO = 2;

    public static function customName(int $case): string
    {
        return match ($case) {
            self::PENDIENTE->value => 'Pendiente',
            self::PAGADO->value => 'Pagado',
            default => '',
        };
    }

    public static function classCss(int $case): string|null
    {
        return match ($case) {
            self::PENDIENTE->value => 'fine-pending',
            self::PAGADO->value => 'fine-paid',
            default => null,
        };
    }
}
