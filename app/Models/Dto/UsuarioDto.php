<?php

namespace App\Models\Dto;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class UsuarioDto extends Data
{
    public function __construct(
        public ?int        $id,
        public ?string     $nombreCompleto,
        public ?string     $correo,
        public ?string     $contrasenia,
        public ?string     $telefono,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d')]
        public ?Carbon     $fechaNacimiento,
        public ?int        $sexoId,
        public ?int        $estatusId,
        public ?int        $rolId,
        public ?int        $tipoId,
        public ?ExternoDto $externo,
        public ?EscolarDto $escolar,
        public ?AlumnoDto  $alumno,
        public ?DonacionUsuarioDto $donacionUsuario,

        public ?string     $contraseniaActual,
    ) {
        //
    }
}
