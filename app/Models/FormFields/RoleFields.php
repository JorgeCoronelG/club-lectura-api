<?php

namespace App\Models\FormFields;

enum RoleFields: int
{
    case Admin = 1;
    case Capturist = 2;
    case Reader = 3;

    public static function getAllRoles(): array
    {
        return [self::Admin->value, self::Capturist->value, self::Reader->value];
    }
}
