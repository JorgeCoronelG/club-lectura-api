<?php

namespace App\Models\Enums;

enum ConditionBook: int
{
    case New = 1;
    case Used = 2;

    public static function getAllConditions(): array
    {
        return [self::New->value, self::Used->value];
    }
}
