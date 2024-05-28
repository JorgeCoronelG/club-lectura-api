<?php

namespace App\Repositories;

use App\Contracts\Repositories\DonationRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\Donacion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class DonationRepository extends BaseRepository implements DonationRepositoryInterface
{
    protected Builder|Model|QueryBuilder $entity;

    public function __construct(Donacion $donation)
    {
        $this->entity = $donation;
    }
}
