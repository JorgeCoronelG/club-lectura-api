<?php

namespace App\Repositories;

use App\Contracts\Repositories\ILoanRepository;
use App\Core\BaseRepository;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 12/01/2022
 */
class LoanRepository extends BaseRepository implements ILoanRepository
{
    protected Builder|Model $entity;

    /**
     * @param Loan $loan
     */
    public function __construct(Loan $loan)
    {
        $this->entity = $loan;
    }
}
