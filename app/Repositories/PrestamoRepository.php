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
        $filterUser = array_values(array_filter($filters, fn ($filter) => $filter->field === 'usuario'));
        $filterBook = array_values(array_filter($filters, fn ($filter) => $filter->field === 'libro'));
        $filterFine = array_values(array_filter($filters, fn ($filter) => $filter->field === 'multa' || $filter->field === 'estatus_multa'));
        $filters = array_filter($filters, fn ($filter) => !in_array($filter->field, ['usuario', 'libro', 'multa', 'estatus_multa']));

        return $this->entity
            ->with([
                'multa',
                'multa.estatus',
                'usuario',
                'libros',
                'estatus'
            ])
            ->when($filterUser, function (Builder $query) use ($filterUser) {
                $query->whereHas('usuario', function (Builder $query) use ($filterUser) {
                    $filter = [new Filter('nombre_completo', $filterUser[0]->value, $filterUser[0]->operator)];
                    $query->filter($filter);
                });
            })
            ->when($filterBook, function (Builder $query) use ($filterBook) {
                $query->whereHas('libros', function (Builder $query) use ($filterBook) {
                    $filter = [new Filter('titulo', $filterBook[0]->value, $filterBook[0]->operator)];
                    $query->filter($filter);
                });
            })
            ->when($filterFine, function (Builder $query) use ($filterFine) {
                $filterMulta = array_values(array_filter($filterFine, fn ($filter) => $filter->field === 'multa'));

                if (count($filterMulta) === 1) {
                    $query
                        ->when($filterMulta[0]->operator === OperatorSql::IS_NULL, function (Builder $query) {
                            $query->whereDoesntHave('multa');
                        })
                        ->when($filterMulta[0]->operator !== OperatorSql::IS_NULL, function (Builder $query) use ($filterFine) {
                            $query->whereHas('multa', function (Builder $query) use ($filterFine) {
                                $filterApply = [];
                                $nameFields = ['multa' => 'costo', 'estatus_multa' => 'estatus_id'];

                                foreach ($filterFine as $filter) {
                                    if ($filter->field === 'multa' && $filter->operator === OperatorSql::NOT_NULL) {
                                        continue;
                                    }

                                    $filterApply[] = new Filter($nameFields[$filter->field], $filter->value, $filter->operator);
                                }

                                if (count($filterApply) > 0) {
                                    $query->filter($filterApply);
                                }
                            });
                        });
                    return;
                }

                $query
                    ->whereHas('multa', function (Builder $query) use ($filterFine) {
                        $filterApply = [new Filter('estatus_id', $filterFine[0]->value, $filterFine[0]->operator)];

                        $query->filter($filterApply);
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
                'estatus',
                'libros',
                'multa',
                'multa.estatus',
                'usuario'
            ])
            ->findOrFail($id, $columns);
    }

    public function findAllByReaderPaginated(int $userId, array $filters, int $limit, string $sort = null, array $columns = ['*']): LengthAwarePaginator
    {
        $filterUser = array_values(array_filter($filters, fn ($filter) => $filter->field === 'usuario'));
        $filterBook = array_values(array_filter($filters, fn ($filter) => $filter->field === 'libro'));
        $filterFine = array_values(array_filter($filters, fn ($filter) => $filter->field === 'multa' || $filter->field === 'estatus_multa'));
        $filters = array_filter($filters, fn ($filter) => !in_array($filter->field, ['usuario', 'libro', 'multa', 'estatus_multa']));

        return $this->entity
            ->with([
                'multa',
                'multa.estatus',
                'usuario',
                'libros',
                'estatus'
            ])
            ->where('usuario_id', $userId)
            ->when($filterUser, function (Builder $query) use ($filterUser) {
                $query->whereHas('usuario', function (Builder $query) use ($filterUser) {
                    $filter = [new Filter('nombre_completo', $filterUser[0]->value, $filterUser[0]->operator)];
                    $query->filter($filter);
                });
            })
            ->when($filterBook, function (Builder $query) use ($filterBook) {
                $query->whereHas('libros', function (Builder $query) use ($filterBook) {
                    $filter = [new Filter('titulo', $filterBook[0]->value, $filterBook[0]->operator)];
                    $query->filter($filter);
                });
            })
            ->when($filterFine, function (Builder $query) use ($filterFine) {
                $filterMulta = array_values(array_filter($filterFine, fn ($filter) => $filter->field === 'multa'));

                if (count($filterMulta) === 1) {
                    $query
                        ->when($filterMulta[0]->operator === OperatorSql::IS_NULL, function (Builder $query) {
                            $query->whereDoesntHave('multa');
                        })
                        ->when($filterMulta[0]->operator !== OperatorSql::IS_NULL, function (Builder $query) use ($filterFine) {
                            $query->whereHas('multa', function (Builder $query) use ($filterFine) {
                                $filterApply = [];
                                $nameFields = ['multa' => 'costo', 'estatus_multa' => 'estatus_id'];

                                foreach ($filterFine as $filter) {
                                    if ($filter->field === 'multa' && $filter->operator === OperatorSql::NOT_NULL) {
                                        continue;
                                    }

                                    $filterApply[] = new Filter($nameFields[$filter->field], $filter->value, $filter->operator);
                                }

                                if (count($filterApply) > 0) {
                                    $query->filter($filterApply);
                                }
                            });
                        });
                    return;
                }

                $query
                    ->whereHas('multa', function (Builder $query) use ($filterFine) {
                        $filterApply = [new Filter('estatus_id', $filterFine[0]->value, $filterFine[0]->operator)];

                        $query->filter($filterApply);
                    });
            })
            ->filter($filters)
            ->applySort($sort)
            ->paginate($limit, $columns);
    }
}
