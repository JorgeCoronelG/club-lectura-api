<?php

namespace App\Repositories;

use App\Contracts\Repositories\PrestamoRepositoryInterface;
use App\Core\BaseRepository;
use App\Core\Classes\Filter;
use App\Core\Enum\OperatorSql;
use App\Models\Enum\CatalogoOpciones\EstatusMultaEnum;
use App\Models\Enum\CatalogoOpciones\EstatusPrestamoEnum;
use App\Models\Prestamo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
        $filterFine = array_filter($filters, fn ($filter) => $filter->field === 'multa');
        $filters = array_filter($filters, fn ($filter) => !in_array($filter->field, ['usuario', 'libro', 'multa']));

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
            ->when($filterFine, function (Builder $query) use ($filterFine) {
                $query
                    ->when($filterFine[0]->operator === OperatorSql::IS_NULL, function (Builder $query) {
                        $query->whereDoesntHave('multa');
                    })
                    ->when($filterFine[0]->operator !== OperatorSql::IS_NULL, function (Builder $query) use ($filterFine) {
                        $query->whereHas('multa', function (Builder $query) use ($filterFine) {
                            $filter = [new Filter('costo', $filterFine[0]->value, $filterFine[0]->operator)];
                            $query->where(function (Builder $query) use ($filter) {
                                $query->filter($filter);
                            });
                        });
                    });
            })
            ->filter($filters)
            ->applySort($sort)
            ->paginate($limit, $columns);
    }

    public function loansByUserId(int $userId): Collection
    {
        return $this->entity
            ->whereHas('estatus', function (Builder $query) {
                $query->where('opcion_id', EstatusPrestamoEnum::PRESTAMO->value);
            })
            ->where('usuario_id', $userId)
            ->get();
    }

    public function loansForFines(array $columns = ['*']): Collection
    {
        return $this->entity
            ->where('fecha_entrega', '<', now())
            ->whereHas('estatus', function (Builder $query) {
                $query->where('opcion_id', EstatusPrestamoEnum::PRESTAMO->value);
            })
            ->whereNotIn('id', function (QueryBuilder $query) {
                $query
                    ->select('m.prestamo_id')
                    ->from('multas AS m')
                    ->join('catalogo_opciones AS co', 'co.id', '=', 'm.estatus_id')
                    ->where('co.opcion_id', EstatusMultaEnum::PENDIENTE->value);
            })
            ->get($columns);
    }

    public function findById(int $id, array $columns = ['*']): Prestamo
    {
        return $this->entity
            ->with([
                'libros'
            ])
            ->findOrFail($id, $columns);
    }
}
