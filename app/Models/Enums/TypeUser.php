<?php

namespace App\Models\Enums;

enum TypeUser: int
{
    case Student = 1;
    case Academic = 2;
    case External = 3;

    public static function getAllTypes(): array
    {
        return [self::Student->value, self::Academic->value, self::External->value];
    }
}
