<?php

namespace App\Repositories;

use App\Contracts\Repositories\IFineRepository;
use App\Core\BaseRepository;
use App\Models\Fine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 14/01/2022
 */
class FineRepository extends BaseRepository implements IFineRepository
{
    protected Builder|Model $entity;

    /**
     * @param Fine $fine
     */
    public function __construct(Fine $fine)
    {
        $this->entity = $fine;
    }
}
