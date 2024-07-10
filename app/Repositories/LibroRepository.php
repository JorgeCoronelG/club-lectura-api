<?php

namespace App\Repositories;

use App\Contracts\Repositories\LibroRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\Enum\CatalogoOpciones\EstatusLibroEnum;
use App\Models\Libro;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
            ->applySort($sort)
            ->paginate($limit, $columns);
    }

    public function findById(int $id, array $columns = ['*']): Libro
    {
        return $this->entity
            ->with([
                'estadoFisico',
                'idioma',
                'estatus',
                'genero',
                'autores',
                'donacion',
            ])
            ->findOrFail($id, $columns);
    }

    public function findAllLibraryPaginated(array $filters, int $limit, string $sort = null, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->entity
            ->with([
                'estadoFisico',
                'idioma',
                'estatus',
                'genero',
            ])
            ->whereHas('estatus', function (Builder $query) {
                $query->where('opcion_id', '!=', EstatusLibroEnum::PERDIDO->value);
            })
            ->filter($filters)
            ->applySort($sort)
            ->paginate($limit, $columns);
    }

    public function findBooksOnLoan(array $bookIds): Collection
    {
        return $this->entity
            ->whereHas('prestamos')
            ->whereHas('estatus', function (Builder $query) {
                $query->where('opcion_id', EstatusLibroEnum::PRESTAMO->value);
            })
            ->whereIn('id', $bookIds)
            ->get();
    }

    public function findAllForLoan(): Collection
    {
        return $this->entity
            ->whereHas('estatus', function (Builder $query) {
                $query->where('opcion_id', EstatusLibroEnum::DISPONIBLE->value);
            })
            ->orderBy('titulo')
            ->get();
    }

    public function countExistBooks(): int
    {
        return $this->entity
            ->whereHas('estatus', function (Builder $query) {
                $query->where('opcion_id', '!=', EstatusLibroEnum::PERDIDO->value);
            })
            ->count();
    }
}
