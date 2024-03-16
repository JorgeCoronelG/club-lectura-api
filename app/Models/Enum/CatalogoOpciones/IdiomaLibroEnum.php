<?php

namespace App\Models\Enum\CatalogoOpciones;

use App\Core\Traits\EnumToArray;

enum IdiomaLibroEnum: int
{
    use EnumToArray;

    case ESPANIOL = 1;
    case INGLES = 2;

    static function customName(int $case): string
    {
        return match ($case) {
            self::ESPANIOL->value => 'Español',
            self::INGLES->value => 'Inglés',
            default => '',
        };
    }
}
