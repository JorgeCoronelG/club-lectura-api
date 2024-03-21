<?php

namespace App\Repositories;

use App\Contracts\Repositories\LibroRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\Libro;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;

class LibroRepository extends BaseRepository implements LibroRepositoryInterface
{
    protected Builder|Model|QueryBuilder $entity;

    public function __construct(Libro $libro)
    {
        $this->entity = $libro;
    }

    public function findAllPaginated(
        array $filters,
        int $limit,
        string $sort = null,
        array $columns = ['*']
    ): LengthAwarePaginator
    {
        return $this->entity
            ->with([
                'estadoFisico',
                'idioma',
                'estatus',
                'genero',
            ])
            ->filter($filters)
            ->applySort()
            ->paginate($limit, $columns);
    }
}
