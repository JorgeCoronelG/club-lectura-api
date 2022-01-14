<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\IBaseRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 12/01/2022
 */
interface ILoanRepository extends IBaseRepository
{
    public function findDeliveryExpired(): Collection;
}
