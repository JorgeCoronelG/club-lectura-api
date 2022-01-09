<?php

namespace App\Models\Constants;

class BookFields
{
    const CODE_LENGTH = 15;
    const CODE_INITIAL = 'LIB-';
    const TITLE_MIN_LENGTH = 2;
    const TITLE_MAX_LENGTH = 150;
    const NEW_CONDITION = 'Nuevo';
    const USED_CONDITION = 'Usado';
    const ALL_CONDITIONS = [self::NEW_CONDITION, self::USED_CONDITION];
    const PRICE_TOTAL_DIGITS = 6;
    const PRICE_TOTAL_DECIMAL = 2;
    const IMAGE_LENGTH = 35;
    const AVAILABLE_STATUS = 'Disponible';
    const ON_LOAN_STATUS = 'En préstamo';
    const LOST_STATUS = 'Perdido';
    const NOT_RECOVERED_STATUS = 'No recuperado';
    const ALL_STATUS = [self::AVAILABLE_STATUS, self::ON_LOAN_STATUS, self::LOST_STATUS, self::NOT_RECOVERED_STATUS];
}
