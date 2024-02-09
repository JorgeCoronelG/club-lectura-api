<?php

namespace App\Models\Dto;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class AutorLibroDto extends Data
{
    public function __construct(
        public ?int $autorId,
        public ?int $libroId,
    ) {
        //
    }
}
