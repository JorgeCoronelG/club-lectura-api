<?php

namespace App\Models\Data;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class DonacionUsuario
{
    public function __construct(
        public ?int $donacionId,
        public ?int $usuarioId,
        public ?string $referencia,
    ) {
        //
    }
}
