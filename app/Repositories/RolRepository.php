<?php

namespace App\Repositories;

use App\Contracts\Repositories\RolRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\Rol;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class RolRepository extends BaseRepository implements RolRepositoryInterface
{
    protected Builder|Model|QueryBuilder $entity;

    public function __construct(Rol $rol)
    {
        $this->entity = $rol;
    }
}
