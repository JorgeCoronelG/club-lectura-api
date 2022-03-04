<?php

namespace App\Models\FormFields;

class UserFields
{
    final const CODE_LENGTH = 15;
    final const CODE_INITIAL = 'CLUB/LECT-';
    final const NAME_MIN_LENGTH = 3;
    final const NAME_MAX_LENGTH = 120;
    final const LAST_NAME_MIN_LENGTH = 3;
    final const LAST_NAME_MAX_LENGTH = 120;
    final const EMAIL_MIN_LENGTH = 10;
    final const EMAIL_MAX_LENGTH = 120;
    final const PASSWORD_MIN_LENGTH = 8;
    final const PASSWORD_MAX_LENGTH = 50;
    final const RESTORE_PASSWORD_LENGTH = 15;
    final const PHONE_LENGTH = 10;
    final const PHOTO_LENGTH = 50;
    final const PHOTO_DEFAULT = 'default_user.png';
    final const VERIFIED = true;
    final const NOT_VERIFIED = false;
    final const VERIFICATION_TOKEN_LENGTH = 100;
}
