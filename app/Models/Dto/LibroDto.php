<?php

namespace App\Models\Dto;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class LibroDto extends Data
{
    public function __construct(
        public ?int $id,
        public ?string $clave,
        public ?string $isbn,
        public ?string $titulo,
        public ?string $resenia,
        public ?int $numPaginas,
        public ?int $estadoFisicoId,
        public ?float $precio,
        public ?int $edicion,
        public ?string $imagen,
        public ?int $numCopia,
        public ?int $idiomaId,
        public ?int $estatusId,
        public ?int $donacionId,
        public ?int $generoId,
    ) {
        //
    }
}
