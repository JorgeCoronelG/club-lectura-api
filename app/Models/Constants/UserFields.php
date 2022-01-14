<?php

namespace App\Models\Constants;

class UserFields
{
    const CODE_LENGTH = 15;
    const CODE_INITIAL = 'CLUB/LECT-';
    const NAME_MIN_LENGTH = 3;
    const NAME_MAX_LENGTH = 120;
    const LAST_NAME_MIN_LENGTH = 3;
    const LAST_NAME_MAX_LENGTH = 120;
    const EMAIL_MIN_LENGTH = 10;
    const EMAIL_MAX_LENGTH = 120;
    const PHONE_LENGTH = 10;
    const MALE_GENDER = 'Hombre';
    const FEMALE_GENDER = 'Mujer';
    const ALL_GENDER = [self::MALE_GENDER, self::FEMALE_GENDER];
    const PHOTO_LENGTH = 50;
    const ACTIVE_STATUS = 'Activo';
    const INACTIVE_STATUS = 'Inactivo';
    const BLOCKED_STATUS = 'En deuda';
    const ALL_STATUS = [self::ACTIVE_STATUS, self::INACTIVE_STATUS, self::BLOCKED_STATUS];
    const VERIFIED = true;
    const NOT_VERIFIED = false;
    const VERIFICATION_TOKEN_LENGTH = 100;
}
