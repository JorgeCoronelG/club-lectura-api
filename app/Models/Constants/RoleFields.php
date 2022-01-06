<?php

namespace App\Models\Constants;

class RoleFields
{
    const ADMIN = 1;
    const CAPTURIST = 2;
    const READER = 3;
    const ALL_ROLES_ARR = [self::ADMIN, self::CAPTURIST, self::READER];
}
