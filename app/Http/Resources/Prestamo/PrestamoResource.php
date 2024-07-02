<?php

namespace App\Http\Resources\Prestamo;

use App\Http\Resources\CatalogoOpcion\CatalogoOpcionResource;
use App\Http\Resources\Libro\LibroCollection;
use App\Http\Resources\Multa\MultaResource;
use App\Http\Resources\Usuario\UsuarioResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrestamoResource extends JsonResource
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
            'fechaPrestamo' => $this->fecha_prestamo->format('Y-m-d'),
            'fechaEntrega' => $this->fecha_entrega->format('Y-m-d'),
            'fechaRealEntrega' => ($this->fecha_real_entrega)
                ? $this->fecha_real_entrega->format('Y-m-d')
                : null,
            'usuarioId' => $this->usuario_id,
            'usuario' => UsuarioResource::make($this->whenLoaded('usuario')),
            'libros' => LibroCollection::make($this->whenLoaded('libros')),
            'estatusId' => $this->estatus_id,
            'estatus' => CatalogoOpcionResource::make($this->whenLoaded('estatus')),
            'multa' => MultaResource::make($this->whenLoaded('multa')),
        ];
    }
}
