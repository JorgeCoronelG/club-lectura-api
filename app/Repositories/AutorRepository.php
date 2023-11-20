<?php

namespace App\Repositories;

use App\Contracts\Repositories\AutorRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\Autor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class AutorRepository extends BaseRepository implements AutorRepositoryInterface
{
    protected Builder|Model|QueryBuilder $entity;

    public function __construct(Autor $autor)
    {
        $this->entity = $autor;
    }
}
