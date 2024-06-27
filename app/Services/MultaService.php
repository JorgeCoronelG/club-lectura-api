<?php

namespace App\Services;

use App\Contracts\Repositories\CatalogoOpcionRepositoryInterface;
use App\Contracts\Repositories\MultaRepositoryInterface;
use App\Contracts\Repositories\PrestamoRepositoryInterface;
use App\Contracts\Services\MultaServiceInterface;
use App\Core\BaseService;
use App\Core\Contracts\BaseRepositoryInterface;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\CostoMultaEnum;
use App\Models\Enum\CatalogoOpciones\EstatusMultaEnum;

class MultaService extends BaseService implements MultaServiceInterface
{
    protected BaseRepositoryInterface $entityRepository;
    protected PrestamoRepositoryInterface $prestamoRepository;
    protected CatalogoOpcionRepositoryInterface $catalogoOpcionRepository;

    public function __construct(
        MultaRepositoryInterface $multaRepository,
        PrestamoRepositoryInterface $prestamoRepository,
        CatalogoOpcionRepositoryInterface $catalogoOpcionRepository,
    ) {
        $this->entityRepository = $multaRepository;
        $this->prestamoRepository = $prestamoRepository;
        $this->catalogoOpcionRepository = $catalogoOpcionRepository;
    }

    public function createOrUpdateFines(): void
    {
        $amountFine = $this->catalogoOpcionRepository->findByOpcionIdAndCatalogoId(
            CostoMultaEnum::POR_DIA->value,
            CatalogoEnum::COSTO_MULTA_POR_DIA->value
        );

        $this->entityRepository->updateFines(floatval($amountFine->valor));

        $loans = $this->prestamoRepository->loansForFines(['id']);

        if ($loans->count() > 0) {
            $data = [];
            $statusFine = $this->catalogoOpcionRepository->findByOpcionIdAndCatalogoId(
                EstatusMultaEnum::PENDIENTE->value,
                CatalogoEnum::ESTATUS_MULTA->value
            );
            foreach ($loans as $loan) {
                $data[] = [
                    'costo' => floatval($amountFine->valor),
                    'estatus_id' => $statusFine->id,
                    'prestamo_id' => $loan->id
                ];
            }
            $this->entityRepository->bulkInsert($data);
        }
    }
}
