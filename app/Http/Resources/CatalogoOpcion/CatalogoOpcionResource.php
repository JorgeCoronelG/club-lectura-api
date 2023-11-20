<?php

namespace App\Http\Resources\CatalogoOpcion;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CatalogoOpcionResource extends JsonResource
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
            'opcionId' => $this->opcion_id,
            'catalogoId' => $this->catalogo_id,
            'valor' => $this->valor,
            'estatus' => $this->estatus,
        ];
    }
}
