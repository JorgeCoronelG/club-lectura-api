<?php

namespace App\Http\Resources\Alumno;

use App\Http\Resources\CatalogoOpcion\CatalogoOpcionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlumnoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'usuarioId' => $this->usuario_id,
            'grupo' => $this->grupo,
            'turnoId' => $this->turno_id,
            'turno' => CatalogoOpcionResource::make($this->whenLoaded('turno')),
        ];
    }
}
