<?php

namespace App\Repositories;

use App\Contracts\Repositories\PrestamoRepositoryInterface;
use App\Core\BaseRepository;
use App\Core\Classes\Filter;
use App\Models\Prestamo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;

class PrestamoRepository extends BaseRepository implements PrestamoRepositoryInterface
{
    protected Builder|Model|QueryBuilder $entity;

    public function __construct(Prestamo $prestamo)
    {
        $this->entity = $prestamo;
    }

    /**
     * @param Filter[] $filters
     * @param int $limit
     * @param string|null $sort
     * @param string[] $columns
     * @return LengthAwarePaginator
     */
    public function findAllPaginated(
        array $filters,
        int $limit,
        string $sort = null,
        array $columns = ['*']
    ): LengthAwarePaginator
    {
        $filterUser = array_filter($filters, fn ($filter) => $filter->field === 'usuario');
        $filterBook = array_filter($filters, fn ($filter) => $filter->field === 'libro');
        $filters = array_filter($filters, fn ($filter) => $filter->field !== 'usuario' && $filter->field !== 'libro');

        return $this->entity
            ->with([
                'multa',
                'usuario',
                'libros',
                'estatus'
            ])
            ->when($filterUser, function (Builder $query) use ($filterUser) {
                $query->whereHas('usuario', function (Builder $query) use ($filterUser) {
                    $filter = [new Filter('nombre_completo', $filterUser[0]->value, $filterUser[0]->operator)];
                    $query->where(function (Builder $query) use ($filter) {
                        $query->filter($filter);
                    });
                });
            })
            ->when($filterBook, function (Builder $query) use ($filterBook) {
                $query->whereHas('libros', function (Builder $query) use ($filterBook) {
                    $filter = [new Filter('titulo', $filterBook[0]->value, $filterBook[0]->operator)];
                    $query->where(function (Builder $query) use ($filter) {
                        $query->filter($filter);
                    });
                });
            })
            ->filter($filters)
            ->applySort($sort)
            ->paginate($limit, $columns);
    }
}
