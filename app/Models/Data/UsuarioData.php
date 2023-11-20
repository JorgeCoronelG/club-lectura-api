<?php

namespace App\Models\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class UsuarioData extends Data
{
    public function __construct(
        public ?int $id,
        public ?string $nombreCompleto,
        public ?string $correo,
        public ?string $contrasenia,
        public ?string $telefono,
        public ?Carbon $fechaNacimiento,
        public ?int $sexoId,
        public ?int $estatusId,
        public ?int $rolId,
    ) {
        //
    }
}
