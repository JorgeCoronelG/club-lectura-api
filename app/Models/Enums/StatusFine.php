<?php

namespace App\Models\Enums;

enum StatusFine: int
{
    case Pending = 1;
    case Paid = 2;

    public static function getAllStatus(): array
    {
        return [self::Pending->value, self::Paid->value];
    }
}
