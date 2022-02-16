<?php

namespace App\Repositories;

use App\Contracts\Repositories\ILoanRepository;
use App\Core\BaseRepository;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 12/01/2022
 */
class LoanRepository extends BaseRepository implements ILoanRepository
{
    protected Builder|Model|QueryBuilder $entity;

    /**
     * @param Loan $loan
     */
    public function __construct(Loan $loan)
    {
        $this->entity = $loan;
    }

    public function findAllExpired(): Collection
    {
        return $this->entity
            ->where('actual_delivery')
            ->where('approximate_delivery', '<', now()->toDateString())
            ->get();
    }
}
