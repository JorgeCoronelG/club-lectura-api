<?php

namespace App\Models\Dto;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class PrestamoDto extends Data
{
    public function __construct(
        public ?int $id,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d')]
        public ?Carbon $fechaPrestamo,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d')]
        public ?Carbon $fechaEntrega,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d')]
        public ?Carbon $fechaRealEntrega,
        public ?int $usuarioId,
        public ?int $estatusId,
        /**
         * @var LibroPrestamoDto[]
         */
        public ?array $libros,
        public ?MultaDto $multa,
    ) {
        //
    }
}
