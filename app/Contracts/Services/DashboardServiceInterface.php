<?php

namespace App\Contracts\Services;

use App\Models\Usuario;

interface DashboardServiceInterface
{
    public function getDashboardStatistics(int $userId): array;
}
