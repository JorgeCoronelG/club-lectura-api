<?php

namespace App\Models\Enums;

enum LanguageBook: int
{
    case Spanish = 1;
    case English = 2;

    public static function getAllLanguages(): array
    {
        return [self::Spanish->value, self:: English->value];
    }
}
