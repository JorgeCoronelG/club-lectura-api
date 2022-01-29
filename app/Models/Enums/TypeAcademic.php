<?php

namespace App\Models\Enums;

enum TypeAcademic: int
{
    case Teacher = 1;
    case Administrative = 2;
    case GeneralStaff = 3;

    public static function getAllTypes(): array
    {
        return [self::Teacher->value, self::Administrative->value, self::GeneralStaff->value];
    }
}
