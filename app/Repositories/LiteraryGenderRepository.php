<?php

namespace App\Repositories;

use App\Contracts\Repositories\ILiteraryGenderRepository;
use App\Core\BaseRepository;
use App\Models\LiteraryGender;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 07/01/2022
 */
class LiteraryGenderRepository extends BaseRepository implements ILiteraryGenderRepository
{
    protected Builder|Model|QueryBuilder $entity;

    /**
     * @param LiteraryGender $literaryGender
     */
    public function __construct(LiteraryGender $literaryGender)
    {
        $this->entity = $literaryGender;
    }

    public function findAll(array $filter = [], string $sort = null, array $columns = ['*']): Collection
    {
        return $this->entity
            ->with('literarySubgenders')
            ->filter($filter)
            ->applySort($sort)
            ->get($columns);
    }
}
