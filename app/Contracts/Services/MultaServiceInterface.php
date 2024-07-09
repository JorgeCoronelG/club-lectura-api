<?php

namespace App\Contracts\Services;

use App\Core\Contracts\BaseServiceInterface;

interface MultaServiceInterface extends BaseServiceInterface
{
    public function createOrUpdateFines(): void;

    public function finePaid(int $id): void;
}
