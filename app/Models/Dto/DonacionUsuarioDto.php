<?php

namespace App\Models\Dto;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class DonacionUsuarioDto
{
    public function __construct(
        public ?int $donacionId,
        public ?int $usuarioId,
        public ?string $referencia,
    ) {
        //
    }
}
