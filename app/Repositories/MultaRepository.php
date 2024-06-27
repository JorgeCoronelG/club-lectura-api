<?php

namespace App\Repositories;

use App\Contracts\Repositories\MultaRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\Enum\CatalogoOpciones\EstatusMultaEnum;
use App\Models\Multa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class MultaRepository extends BaseRepository implements MultaRepositoryInterface
{
    protected Builder|Model|QueryBuilder $entity;

    public function __construct(Multa $multa)
    {
        $this->entity = $multa;
    }

    public function updateFines(float $amount): int
    {
        return $this->entity
            ->whereHas('estatus', function (Builder $query) {
                $query->where('opcion_id', EstatusMultaEnum::PENDIENTE->value);
            })
            ->increment('costo', $amount);
    }
}
