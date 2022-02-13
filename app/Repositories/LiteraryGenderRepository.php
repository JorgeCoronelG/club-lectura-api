<?php

namespace App\Repositories;

use App\Contracts\Repositories\ILiteraryGenderRepository;
use App\Core\BaseRepository;
use App\Models\LiteraryGender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 07/01/2022
 */
class LiteraryGenderRepository extends BaseRepository implements ILiteraryGenderRepository
{
    protected Builder|Model $entity;

    /**
     * @param LiteraryGender $literaryGender
     */
    public function __construct(LiteraryGender $literaryGender)
    {
        $this->entity = $literaryGender;
    }
}
