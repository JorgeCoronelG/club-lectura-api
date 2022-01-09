<?php

namespace App\Repositories;

use App\Contracts\Repositories\ILiterarySubgenderRepository;
use App\Core\BaseRepository;
use App\Models\LiterarySubgender;
use Illuminate\Database\Eloquent\Model;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 07/01/2022
 */
class LiterarySubgenderRepository extends BaseRepository implements ILiterarySubgenderRepository
{
    protected Model $entity;

    /**
     * @param LiterarySubgender $literarySubgender
     */
    public function __construct(LiterarySubgender $literarySubgender)
    {
        $this->entity = $literarySubgender;
    }
}
