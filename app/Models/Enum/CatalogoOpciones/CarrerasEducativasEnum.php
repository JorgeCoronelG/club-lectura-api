<?php

namespace App\Models\Enum\CatalogoOpciones;

use App\Core\Traits\EnumToArray;

enum CarrerasEducativasEnum: int
{
    use EnumToArray;

    case MECATRONICA = 1;
    case ELECTRICIDAD = 2;
    case ELECTROMECANICA = 3;
    case LOGISTICA = 4;
    case TRANSFORMACION_PLASTICOS = 5;
    case BIOTECNOLOGIA = 6;
    case ELECTRONICA = 7;
    case PRODUCCION_INDUSTRIAL = 8;
    case PROGRAMACION = 9;
    case MANTENIMIENTO_INDUSTRIAL = 10;
    case PROCESOS_GESTION_ADMINISTRATIVA = 11;
    case MANTENIMIENTO_AUTOMOTRIZ = 12;
    case MAQUINAS_HERRAMIENTA = 13;

    static function customName(int $case): string
    {
        return match ($case) {
            self::MECATRONICA->value => 'Mecatrónica',
            self::ELECTRICIDAD->value => 'Electricidad',
            self::ELECTROMECANICA->value => 'Electromecánica',
            self::LOGISTICA->value => 'Logística',
            self::TRANSFORMACION_PLASTICOS->value => 'Transformación de Plásticos',
            self::BIOTECNOLOGIA->value => 'Biotecnología',
            self::ELECTRONICA->value => 'Electrónica',
            self::PRODUCCION_INDUSTRIAL->value => 'Producción Industrial',
            self::PROGRAMACION->value => 'Programación',
            self::MANTENIMIENTO_INDUSTRIAL->value => 'Mantenimiento Industrial',
            self::PROCESOS_GESTION_ADMINISTRATIVA->value => 'Proceso de Gestión Administrativa',
            self::MANTENIMIENTO_AUTOMOTRIZ->value => 'Mantenimiento Automotriz',
            self::MAQUINAS_HERRAMIENTA->value => 'Máquinas Herramienta',
            default => '',
        };
    }
}
