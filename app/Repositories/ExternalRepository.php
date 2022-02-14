<?php

namespace App\Repositories;

use App\Contracts\Repositories\IExternalRepository;
use App\Core\BaseRepository;
use App\Models\External;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 08/01/2022
 */
class ExternalRepository extends BaseRepository implements IExternalRepository
{
    protected Builder|Model $entity;

    /**
     * @param External $external
     */
    public function __construct(External $external)
    {
        $this->entity = $external;
    }


}
