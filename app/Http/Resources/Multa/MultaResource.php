<?php

namespace App\Http\Resources\Multa;

use App\Http\Resources\CatalogoOpcion\CatalogoOpcionResource;
use App\Http\Resources\Prestamo\PrestamoResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MultaResource extends JsonResource
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
            'costo' => $this->costo,
            'estatusId' => $this->estatus_id,
            'estatus' => CatalogoOpcionResource::make($this->whenLoaded('estatus')),
            'prestamoId' => $this->prestamo_id,
            'prestamo' => PrestamoResource::make($this->whenLoaded('prestamo'))
        ];
    }
}
