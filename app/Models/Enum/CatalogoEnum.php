<?php

namespace App\Models\Enum;

use App\Core\Traits\EnumToArray;

enum CatalogoEnum: int
{
    use EnumToArray;

    case ESTATUS_USUARIO = 1;
    case SEXO = 2;
    case TIPO_ESCOLAR = 3;
    case TURNO_ALUMNO = 4;
    case TIPO_USUARIO = 5;
    case CARRERAS_EDUCATIVAS = 6;
    case ESTADO_FISICO_LIBRO = 7;
    case IDIOMA = 8;
    case ESTATUS_LIBRO = 9;
    case ESTATUS_PRESTAMO = 10;

    static function customName(int $case): string
    {
        return match ($case) {
            self::ESTATUS_USUARIO->value => 'Estatus Usuario',
            self::SEXO->value => 'Género',
            self::TIPO_ESCOLAR->value => 'Tipo Escolar',
            self::TURNO_ALUMNO->value => 'Turno Alumno',
            self::TIPO_USUARIO->value => 'Tipo Usuario',
            self::CARRERAS_EDUCATIVAS->value => 'Carreras Educativas',
            self::ESTADO_FISICO_LIBRO->value => 'Estado físico del libro',
            self::IDIOMA->value => 'Idioma',
            self::ESTATUS_LIBRO->value => 'Estatus Libro',
            self::ESTATUS_PRESTAMO->value => 'Estatus del préstamo',
            default => '',
        };
    }
}
