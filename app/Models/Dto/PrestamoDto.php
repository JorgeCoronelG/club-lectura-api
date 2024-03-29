<?php

namespace App\Models\Dto;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class PrestamoDto extends Data
{
    public function __construct(
        public ?int $id,
        public ?Carbon $fechaPrestamo,
        public ?Carbon $fechaEntrega,
        public ?Carbon $fechaRealEntrega,
        public ?int $usuarioId,
    ) {
        //
    }
}
