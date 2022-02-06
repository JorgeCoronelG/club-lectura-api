<?php

namespace Database\Seeders;

use App\Contracts\Repositories\IFineRepository;
use App\Contracts\Repositories\ILoanRepository;
use App\Models\Enums\StatusFine;
use App\Models\FormFields\FineFields;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FineSeeder extends Seeder
{
    protected ILoanRepository $loanRepository;
    protected IFineRepository $fineRepository;

    /**
     * @param ILoanRepository $loanRepository
     * @param IFineRepository $fineRepository
     */
    public function __construct(ILoanRepository $loanRepository, IFineRepository $fineRepository)
    {
        $this->loanRepository = $loanRepository;
        $this->fineRepository = $fineRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loans = $this->loanRepository->findDeliveryExpired();

        $loans->each(function (Loan $loan) {
            $diff = Carbon::now()->diffInDays(Carbon::parse($loan->approximate_delivery));

            $this->fineRepository->create([
                'cost' => $diff * FineFields::FINE_PER_DAY,
                'status' => StatusFine::Pending->value,
                'loan_id' => $loan->id
            ]);
        });
    }
}
