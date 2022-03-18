<?php

namespace App\Models\FormFields;

class UserFields
{
    final const CODE_INITIAL = 'CLUB/LECT-';
    final const COMPLETE_NAME_MIN_LENGTH = 3;
    final const COMPLETE_NAME_MAX_LENGTH = 150;
    final const EMAIL_MIN_LENGTH = 10;
    final const EMAIL_MAX_LENGTH = 120;
    final const PHONE_LENGTH = 10;
    final const PHOTO_LENGTH = 50;
    final const PHOTO_DEFAULT = 'default_user.png';
    final const VERIFIED = true;
    final const NOT_VERIFIED = false;
    final const VERIFICATION_TOKEN_LENGTH = 100;
}
