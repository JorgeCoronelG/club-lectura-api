<?php

namespace App\Services;

use App\Contracts\Repositories\CatalogoOpcionRepositoryInterface;
use App\Contracts\Repositories\LibroRepositoryInterface;
use App\Contracts\Repositories\PrestamoRepositoryInterface;
use App\Contracts\Services\PrestamoServiceInterface;
use App\Core\BaseService;
use App\Core\Contracts\BaseRepositoryInterface;
use App\Exceptions\CustomErrorException;
use App\Models\Dto\LibroDto;
use App\Models\Dto\PrestamoDto;
use App\Models\Enum\CatalogoEnum;
use App\Models\Enum\CatalogoOpciones\EstatusLibroEnum;
use App\Models\Enum\CatalogoOpciones\EstatusPrestamoEnum;
use App\Models\Prestamo;
use Spatie\LaravelData\Data;
use Symfony\Component\HttpFoundation\Response;

class PrestamoService extends BaseService implements PrestamoServiceInterface
{
    protected BaseRepositoryInterface $entityRepository;
    protected CatalogoOpcionRepositoryInterface $catalogoOpcionRepository;
    protected LibroRepositoryInterface $libroRepository;

    public function __construct(
        PrestamoRepositoryInterface $prestamoRepository,
        CatalogoOpcionRepositoryInterface $catalogoOpcionRepository,
        LibroRepositoryInterface $libroRepository,
    ) {
        $this->entityRepository = $prestamoRepository;
        $this->catalogoOpcionRepository = $catalogoOpcionRepository;
        $this->libroRepository = $libroRepository;
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
}
