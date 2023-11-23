<?php

namespace App\Http\Resources\Usuario;

use App\Http\Resources\Alumno\AlumnoResource;
use App\Http\Resources\CatalogoOpcion\CatalogoOpcionResource;
use App\Http\Resources\Escolar\EscolarResource;
use App\Http\Resources\Externo\ExternoResource;
use App\Http\Resources\Rol\RolResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombreCompleto' => $this->nombre_completo,
            'correo' => $this->correo,
            'telefono' => $this->telefono,
            'fechaNacimiento' => $this->fecha_nacimiento->format('Y-m-d'),
            'sexoId' => $this->sexo_id,
            'sexo' => CatalogoOpcionResource::make($this->whenLoaded('sexo')),
            'estatusId' => $this->estatus_id,
            'estatus' => CatalogoOpcionResource::make($this->whenLoaded('estatus')),
            'rolId' => $this->rol_id,
            'rol' => RolResource::make($this->whenLoaded('rol')),
            'externo' => ExternoResource::make($this->whenLoaded('externo')),
            'escolar' => EscolarResource::make($this->whenLoaded('escolar')),
            'alumno' => AlumnoResource::make($this->whenLoaded('alumno')),
        ];
    }
}
