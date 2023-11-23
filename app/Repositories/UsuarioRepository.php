<?php

namespace App\Repositories;

use App\Contracts\Repositories\UsuarioRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

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

    public function buscarPorCorreo(string $correo): Usuario
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
                'escolar'
            ])
            ->findOrFail($id, $columns);
    }
}
