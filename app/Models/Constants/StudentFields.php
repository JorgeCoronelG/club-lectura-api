<?php

namespace App\Models\Constants;

class StudentFields
{
    const GROUP_MAX_LENGTH = 15;
    const MORNING_TURN = 'Matutino';
    const AFTERNOON_TURN = 'Vespertino';
    const ALL_TURNS = [self::MORNING_TURN, self::AFTERNOON_TURN];
}
