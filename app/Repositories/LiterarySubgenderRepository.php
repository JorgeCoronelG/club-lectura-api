<?php

namespace App\Repositories;

use App\Contracts\Repositories\ILiterarySubgenderRepository;
use App\Core\BaseRepository;
use App\Models\LiterarySubgender;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function findAllPaginated(array $filters, int $limit, string $sort = null, array $columns = ['*']): LengthAwarePaginator {
        return $this->entity
            ->filter($filters)
            ->orWhereHas('literaryGender', function (Builder $query) use ($filters) {
                if (isset($filters['literaryGender']) && trim($filters['literaryGender']) !== '') {
                    $query->where('name', 'LIKE', "%${filters['literaryGender']}%");
                }
            })
            ->with('literaryGender')
            ->applySort($sort)
            ->paginate($limit, $columns);
    }
}
