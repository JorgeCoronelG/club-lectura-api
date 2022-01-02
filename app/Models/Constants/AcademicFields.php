<?php

namespace App\Models\Constants;

class AcademicFields
{
    const REGISTRATION_MAX_LENGTH = 15;
    const TEACHER_TYPE = 'Maestro';
    const ADMINISTRATIVE_TYPE = 'Administrativo';
    const GENERAL_STAFF_TYPE = 'Personal en general';
    const ALL_TYPES = [self::TEACHER_TYPE, self::ADMINISTRATIVE_TYPE, self::GENERAL_STAFF_TYPE];
}
