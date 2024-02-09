<?php

namespace App\Models\Dto;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class MultaDto extends Data
{
    public function __construct(
        public ?int $id,
        public ?float $costo,
        public ?int $estatusId,
        public ?int $prestamoId,
    ) {
        //
    }
}
