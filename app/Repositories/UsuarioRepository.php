<?php

namespace App\Repositories;

use App\Contracts\Repositories\UsuarioRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\Enum\CatalogoOpciones\EstatusPrestamoEnum;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;

class UsuarioRepository extends BaseRepository implements UsuarioRepositoryInterface
{
    protected Builder|Model|QueryBuilder $entity;

    /**
     * @param Usuario $usuario
     */
    public function __construct(Usuario $usuario)
    {
        $this->entity = $usuario;
    }

    public function findByCorreo(string $correo): Usuario
    {
        return $this->entity
            ->where('correo', $correo)
            ->with(['estatus'])
            ->firstOrFail();
    }

    public function findById(int $id, array $columns = ['*']): Usuario
    {
        return $this->entity
            ->with([
                'estatus',
                'sexo',
                'rol',
                'externo',
                'alumno',
                'escolar',
                'tipo'
            ])
            ->findOrFail($id, $columns);
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
                'sexo',
                'estatus',
                'rol'
            ])
            ->filter($filters)
            ->applySort($sort)
            ->paginate($limit, $columns);
    }

    public function findByField(string $field, string $value): ?Usuario
    {
        return $this->entity->where($field, $value)->first();
    }

    public function findAllForLoan(): Collection
    {
        return $this->entity
            ->whereNotIn('id', function (QueryBuilder $query) {
                $query
                    ->select(['usuario_id'])
                    ->from('prestamos AS p')
                    ->join('catalogo_opciones AS co', 'co.id', '=', 'p.estatus_id')
                    ->where('co.opcion_id', EstatusPrestamoEnum::PRESTAMO->value);
            })
            ->orderBy('nombre_completo')
            ->get();
    }
}
