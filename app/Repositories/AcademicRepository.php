<?php

namespace App\Repositories;

use App\Contracts\Repositories\IAcademicRepository;
use App\Core\BaseRepository;
use App\Models\Academic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 26/03/2022
 */
class AcademicRepository extends BaseRepository implements IAcademicRepository
{
    protected Builder|Model|QueryBuilder $entity;

    /**
     * @param Academic $academic
     */
    public function __construct(Academic $academic)
    {
        $this->entity = $academic;
    }
}
