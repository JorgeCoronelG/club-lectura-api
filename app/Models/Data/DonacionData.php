<?php

namespace App\Models\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class DonacionData extends Data
{
    public function __construct(
        public ?int $id,
        public ?string $codigo,
        public ?Carbon $fechaDonacion,
    ) {
        //
    }
}
