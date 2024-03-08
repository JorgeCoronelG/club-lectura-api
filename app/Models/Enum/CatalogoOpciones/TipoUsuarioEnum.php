<?php

namespace App\Models\Enum\CatalogoOpciones;

use App\Core\Traits\EnumToArray;

enum TipoUsuarioEnum: int
{
    use EnumToArray;

    CASE ESCOLAR = 1;

    CASE ALUMNO = 2;

    CASE EXTERNO = 3;

    static function customName(int $case): string
    {
        return match ($case) {
            self::ESCOLAR->value => 'Escolar',
            self::ALUMNO->value => 'Alumno',
            self::EXTERNO->value => 'Externo',
            default => '',
        };
    }
}
