<?php

namespace App\Models\Dto;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class EscolarDto extends Data
{
    public function __construct(
        public ?int $usuarioId,
        public ?string $matricula,
        public ?int $tipoId,
    ) {
        //
    }
}
