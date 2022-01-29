<?php

namespace App\Models\Enums;

enum StatusUser: int {
    case Active = 1;
    case Inactive = 2;
    case Blocked = 3; // En deuda

    public static function getAllStatus(): array
    {
        return [self::Active->value, self::Inactive->value, self::Blocked->value];
    }
}
