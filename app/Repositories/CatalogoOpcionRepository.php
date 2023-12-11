<?php

namespace App\Repositories;

use App\Contracts\Repositories\CatalogoOpcionRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\CatalogoOpcion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class CatalogoOpcionRepository extends BaseRepository implements CatalogoOpcionRepositoryInterface
{
    protected Builder|Model|QueryBuilder $entity;

    public function __construct(CatalogoOpcion $catalogoOpcion)
    {
        $this->entity = $catalogoOpcion;
    }

    public function findByOpcionIdAndCatalogoId(int $opcionId, int $catalogoId): CatalogoOpcion
    {
        return $this->entity
            ->where('opcion_id', $opcionId)
            ->where('catalogo_id', $catalogoId)
            ->firstOrFail();
    }
}
