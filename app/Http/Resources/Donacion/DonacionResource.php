<?php

namespace App\Http\Resources\Donacion;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonacionResource extends JsonResource
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
            'fechaDonacion' => $this->fecha_donacion->format('Y-m-d')
        ];
    }
}
