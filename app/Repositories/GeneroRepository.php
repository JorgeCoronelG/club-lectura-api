<?php

namespace App\Repositories;

use App\Contracts\Repositories\GeneroRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\Genero;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class GeneroRepository extends BaseRepository implements GeneroRepositoryInterface
{
    protected Builder|Model|QueryBuilder $entity;

    public function __construct(Genero $genero)
    {
        $this->entity = $genero;
    }
}
