<?php

namespace App\Repositories;

use App\Contracts\Repositories\MultaRepositoryInterface;
use App\Core\BaseRepository;
use App\Models\Enum\CatalogoOpciones\EstatusMultaEnum;
use App\Models\Enum\CatalogoOpciones\EstatusPrestamoEnum;
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
            ->whereHas('prestamo', function (Builder $query) {
                $query->whereHas('estatus', function (Builder $query) {
                    $query->where('opcion_id', EstatusPrestamoEnum::PRESTAMO->value);
                });
            })
            ->whereHas('estatus', function (Builder $query) {
                $query->where('opcion_id', EstatusMultaEnum::PENDIENTE->value);
            })
            ->increment('costo', $amount);
    }

    public function findByLoanId(int $loanId): ?Multa
    {
        return $this->entity->where('prestamo_id', $loanId)->first();
    }

    public function countAllFines(int $userId = null): int
    {
        return $this->entity
            ->when(!is_null($userId), function (Builder $query) use ($userId) {
                $query->whereHas('prestamo', function (Builder $query) use ($userId) {
                   $query->where('usuario_id', $userId);
                });
            })
            ->count();
    }
}
