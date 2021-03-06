<?php

namespace App\Repositories;

use App\Contracts\Repositories\IDonationRepository;
use App\Core\BaseRepository;
use App\Models\Donation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 08/01/2022
 */
class DonationRepository extends BaseRepository implements IDonationRepository
{
    protected Builder|Model|QueryBuilder $entity;

    /**
     * @param Donation $donation
     */
    public function __construct(Donation $donation)
    {
        $this->entity = $donation;
    }
}
