<?php

namespace App\Models\Enum\CatalogoOpciones;

use App\Core\Traits\EnumToArray;

enum CostoMultaEnum: int
{
    use EnumToArray;

    case POR_DIA = 1;

    public static function customName(int $case): string
    {
        return match ($case) {
            self::POR_DIA->value => '5',
            default => '',
        };
    }
}
