<?php

namespace App\Models\Enums;

enum IsbnBook: int
{
    case ISBN_OLD_LENGTH = 10;
    case ISBN_NEW_LENGTH = 13;

    public static function getAllIsbn(): array
    {
        return [self::ISBN_OLD_LENGTH->value, self::ISBN_NEW_LENGTH->value];
    }
}
