<?php

namespace App\Models\Enums;

enum StatusBook: int
{
    case Available = 1;
    case OnLoan = 2;
    case Lost = 3;
    case NotRecovered = 4;

    public static function getAllStatus(): array
    {
        return [self::Available->value, self::OnLoan->value, self::Lost->value, self::NotRecovered->value];
    }
}
