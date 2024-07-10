<?php

namespace App\Services;

use App\Contracts\Repositories\CatalogoOpcionRepositoryInterface;
use App\Contracts\Repositories\LibroRepositoryInterface;
use App\Contracts\Repositories\MultaRepositoryInterface;
use App\Contracts\Repositories\PrestamoRepositoryInterface;
use App\Contracts\Services\PrestamoServiceInterface;
use App\Core\BaseService;
use App\Core\Contracts\BaseRepositoryInterface;
use App\Core\Enum\QueryParam;
use App\Exceptions\CustomErrorException;
use App\Helpers\Validation;
use App\Models\Dto\LibroDto;
use App\Models\Dto\PrestamoDto;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\EstatusLibroEnum;
use App\Models\Enum\CatalogoOpciones\EstatusPrestamoEnum;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\LaravelData\Data;
use Symfony\Component\HttpFoundation\Response;

class PrestamoService extends BaseService implements PrestamoServiceInterface
{
    protected BaseRepositoryInterface $entityRepository;
    protected CatalogoOpcionRepositoryInterface $catalogoOpcionRepository;
    protected LibroRepositoryInterface $libroRepository;
    protected MultaRepositoryInterface $multaRepository;

    public function __construct(
        PrestamoRepositoryInterface $prestamoRepository,
        CatalogoOpcionRepositoryInterface $catalogoOpcionRepository,
        LibroRepositoryInterface $libroRepository,
        MultaRepositoryInterface $multaRepository,
    ) {
        $this->entityRepository = $prestamoRepository;
        $this->catalogoOpcionRepository = $catalogoOpcionRepository;
        $this->libroRepository = $libroRepository;
        $this->multaRepository = $multaRepository;
    }

    /**
     * @throws CustomErrorException
     */
    public function create(Data|PrestamoDto $data): Prestamo
    {
        $totalUserLoans = $this->entityRepository->loansByUserId($data->usuarioId)->count();

        if ($totalUserLoans > 0) {
            throw new CustomErrorException('El usuario ya cuenta con un préstamo activo', Response::HTTP_BAD_REQUEST);
        }

        $bookIds = array_map(fn (LibroDto $book) => $book->id, $data->libros);
        $booksOnLoan = $this->libroRepository->findBooksOnLoan($bookIds)->count();
        if ($booksOnLoan > 0) {
            throw new CustomErrorException('Existen libros en préstamo', Response::HTTP_BAD_REQUEST);
        }

        $data->estatusId = $this->catalogoOpcionRepository
            ->findByOpcionIdAndCatalogoId(EstatusPrestamoEnum::PRESTAMO->value, CatalogoEnum::ESTATUS_PRESTAMO->value)
            ->id;

        $loan = $this->entityRepository->create(
            $data
                ->only('fechaPrestamo', 'fechaEntrega', 'usuarioId', 'estatusId')
                ->toArray()
        );
        $this->entityRepository->sync($loan->id, 'libros', $bookIds);

        $libroDto = LibroDto::from([]);
        $libroDto->estatusId = $this->catalogoOpcionRepository
            ->findByOpcionIdAndCatalogoId(EstatusLibroEnum::PRESTAMO->value, CatalogoEnum::ESTATUS_LIBRO->value)
            ->id;
        $this->libroRepository->bulkUpdate($bookIds, $libroDto->only('estatusId')->toArray());

        return $loan;
    }

    public function deliver(PrestamoDto $data, int $id): void
    {
        $fine = $this->multaRepository->findByLoanId($id);
        $statusLoan = $this->catalogoOpcionRepository->findById($data->estatusId);
        $loan = $this->entityRepository->findById($id);

        // Si no existe multa y fue entregado en tiempo
        if (!$fine && $statusLoan->opcion_id === EstatusPrestamoEnum::ENTREGADO->value) {
            $bookAvailable = $this->catalogoOpcionRepository->findByOpcionIdAndCatalogoId(
                EstatusLibroEnum::DISPONIBLE->value,
                CatalogoEnum::ESTATUS_LIBRO->value
            );

            $this->entityRepository->update($id, $data->only('fechaRealEntrega', 'estatusId')->toArray());
            $this->libroRepository->update($loan->libros[0]->id, ['estatus_id' => $bookAvailable->id]);
            return;
        }

        // Reporta el libro como perdido sin tener multa
        if (!$fine && $statusLoan->opcion_id === EstatusPrestamoEnum::PERDIDO->value) {
            $bookLost = $this->catalogoOpcionRepository->findByOpcionIdAndCatalogoId(
                EstatusLibroEnum::PERDIDO->value,
                CatalogoEnum::ESTATUS_LIBRO->value
            );

            $this->entityRepository->update($id, $data->only('estatusId')->toArray());
            $this->libroRepository->update($loan->libros[0]->id, ['estatus_id' => $bookLost->id]);

            $data->multa->costo = $loan->libros[0]->precio;
            $data->multa->prestamoId = $id;
            $this->multaRepository->create($data->multa->except('id')->all());
            return;
        }

        // Entrega el libro después del tiempo estimado
        if ($fine && $statusLoan->opcion_id === EstatusPrestamoEnum::ENTREGADO->value) {
            $bookAvailable = $this->catalogoOpcionRepository->findByOpcionIdAndCatalogoId(
                EstatusLibroEnum::DISPONIBLE->value,
                CatalogoEnum::ESTATUS_LIBRO->value
            );

            $this->entityRepository->update($id, $data->only('fechaRealEntrega', 'estatusId')->toArray());
            $this->libroRepository->update($loan->libros[0]->id, ['estatus_id' => $bookAvailable->id]);
            $this->multaRepository->update($loan->id, $data->multa->only('estatusId')->toArray());
            return;
        }

        // Se reporta el libro como perdido y, además, tiene multa
        $bookLost = $this->catalogoOpcionRepository->findByOpcionIdAndCatalogoId(
            EstatusLibroEnum::PERDIDO->value,
            CatalogoEnum::ESTATUS_LIBRO->value
        );

        $this->entityRepository->update($id, $data->only('estatusId')->toArray());
        $this->libroRepository->update($loan->libros[0]->id, ['estatus_id' => $bookLost->id]);

        $data->multa->costo = $fine->costo + $loan->libros[0]->precio;
        $this->multaRepository->update($fine->id, $data->multa->only('estatusId', 'costo')->toArray());
    }

    /**
     * @throws CustomErrorException
     */
    public function findAllByReaderPaginated(Request $request, int $userId): LengthAwarePaginator
    {
        $filters = Validation::getFilters($request->get(QueryParam::FILTERS_KEY));
        $perPage = Validation::getPerPage($request->get(QueryParam::PAGINATION_KEY));
        $sort = $request->get(QueryParam::ORDER_BY_KEY);
        return $this->entityRepository->findAllByReaderPaginated($userId, $filters, $perPage, $sort);
    }
}
