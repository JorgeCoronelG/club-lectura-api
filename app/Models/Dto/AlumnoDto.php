<?php

namespace App\Models\Dto;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class AlumnoDto extends Data
{
    public function __construct(
        public ?int $usuarioId,
        public ?int $semestre,
        public ?int $carreraId,
        public ?int $turnoId,
    ) {
        //
    }
}
