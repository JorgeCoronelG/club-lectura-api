<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\IBaseRepository;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Collection;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 12/01/2022
 *
 * @method Loan create(array $data)
 */
interface ILoanRepository extends IBaseRepository
{
    //
}
