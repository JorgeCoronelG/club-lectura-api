<?php

namespace App\Services;

use App\Contracts\Repositories\LibroRepositoryInterface;
use App\Contracts\Services\LibroServiceInterface;
use App\Core\BaseService;
use App\Core\Contracts\BaseRepositoryInterface;
use App\Core\Enum\Path;
use App\Exceptions\CustomErrorException;
use App\Helpers\File;
use App\Models\Dto\AutorDto;
use App\Models\Dto\LibroDto;
use App\Models\Libro;
use Spatie\LaravelData\Data;

class LibroService extends BaseService implements LibroServiceInterface
{
    protected BaseRepositoryInterface $entityRepository;

    public function __construct(
        LibroRepositoryInterface $libroRepository,
    ) {
        $this->entityRepository = $libroRepository;
    }

    /**
     * @throws CustomErrorException
     */
    public function create(LibroDto|Data $data): Libro
    {
        $data->imagen = File::uploadImage($data->imagenFile, Path::BOOK_IMAGES->value.'/', File::BOOK_HEIGHT_IMAGE);
        $book = $this->entityRepository->create($data->only(
            'isbn', 'titulo', 'resenia', 'numPaginas', 'precio',
            'edicion', 'imagen', 'numCopia', 'estadoFisicoId', 'idiomaId', 'estatusId', 'generoId'
        )->toArray());

        $authorIds = array_map(fn (AutorDto $row) => $row->id, $data->autores);
        $this->entityRepository->sync($book->id, 'autores', $authorIds);

        return $book;
    }

    public function update(int $id, LibroDto|Data $data): Libro
    {
        $book = $this->entityRepository->update($id, $data->only(
            'isbn', 'titulo', 'resenia', 'numPaginas', 'precio',
            'edicion', 'numCopia', 'estadoFisicoId', 'idiomaId', 'estatusId', 'generoId'
        )->toArray());

        $authorIds = array_map(fn (AutorDto $row) => $row->id, $data->autores);
        $this->entityRepository->sync($book->id, 'autores', $authorIds);

        return $book;
    }

    /**
     * @throws CustomErrorException
     */
    public function updateImage(int $id, LibroDto $data): void
    {
        $book = $this->entityRepository->findById($id);
        File::deleteFile(Path::BOOK_IMAGES->value.'/', $book->imagen);
        $data->imagen = File::uploadImage($data->imagenFile, Path::BOOK_IMAGES->value.'/', File::BOOK_HEIGHT_IMAGE);
        $this->entityRepository->update($id, $data->only('imagen')->toArray());
    }
}
