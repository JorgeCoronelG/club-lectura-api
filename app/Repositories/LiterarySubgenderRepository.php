<?php

namespace App\Repositories;

use App\Contracts\Repositories\ILiterarySubgenderRepository;
use App\Core\BaseRepository;
use App\Models\LiterarySubgender;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 07/01/2022
 */
class LiterarySubgenderRepository extends BaseRepository implements ILiterarySubgenderRepository
{
    protected Builder|Model|QueryBuilder $entity;

    /**
     * @param LiterarySubgender $literarySubgender
     */
    public function __construct(LiterarySubgender $literarySubgender)
    {
        $this->entity = $literarySubgender;
    }
}
