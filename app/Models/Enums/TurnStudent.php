<?php

namespace App\Models\Enums;

enum TurnStudent: int
{
    case Morning = 1;
    case Afternoon = 2;

    public static function getAllTurns(): array
    {
        return [self::Morning->value, self::Afternoon->value];
    }
}
