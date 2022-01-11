<?php

namespace App\Models\Constants;

class FineFields
{
    const COST_TOTAL_DIGITS = 6;
    const COST_TOTAL_DECIMAL = 2;
    const PENDING_STATUS = 'Pendiente';
    const PAID_STATUS = 'Pagado';
    const ALL_STATUS = [self::PENDING_STATUS, self::PAID_STATUS];
    const FINE_PER_DAY = 5;
}
