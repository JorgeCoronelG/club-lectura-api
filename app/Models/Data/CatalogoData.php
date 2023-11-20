<?php

namespace App\Models\Data;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class CatalogoData extends Data
{
    public function __construct(
        public ?int $id,
        public ?string $nombre,
    ) {
        //
    }
}
