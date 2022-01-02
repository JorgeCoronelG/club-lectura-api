<?php

namespace App\Models\Constants;

class StudentFields
{
    const GROUP_MAX_LENGTH = 15;
    const MORNING_SHIFT = 'Matutino';
    const AFTERNOON_SHIFT = 'Vespertino';
    const ALL_TURNS = [self::MORNING_SHIFT, self::AFTERNOON_SHIFT];
}
