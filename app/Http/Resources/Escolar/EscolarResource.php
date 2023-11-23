<?php

namespace App\Http\Resources\Escolar;

use App\Http\Resources\CatalogoOpcion\CatalogoOpcionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EscolarResource extends JsonResource
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
            'matricula' => $this->matricula,
            'tipoId' => $this->tipo_id,
            'tipo' => CatalogoOpcionResource::make($this->whenLoaded('tipo')),
        ];
    }
}
