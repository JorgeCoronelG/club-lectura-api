<?php

namespace App\Helpers\Enum;

enum Gender: int
{
    case Female = 1;
    case Male = 2;

    public static function getAllGenders(): array
    {
        return [self::Female->value, self::Male->value];
    }
}
