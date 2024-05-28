<?php

namespace App\Repositories;

use App\Contracts\Repositories\DonacionUsuarioRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\DonacionUsuario;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class DonacionUsuarioRepository extends BaseRepository implements DonacionUsuarioRepositoryInterface
{
    protected Builder|Model|QueryBuilder $entity;

    public function __construct(DonacionUsuario $donacionUsuario)
    {
        $this->entity = $donacionUsuario;
    }
}
