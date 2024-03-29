<?php

namespace App\Core\Traits;

trait EnumToArray
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::names(), self::values());
    }

    public static function classCss(int $case): string | null
    {
        return null;
    }

    abstract static function customName(int $case): string;
}
