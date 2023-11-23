<?php

namespace App\Http\Resources\Externo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExternoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'usuarioId' => $this->usuario_id
        ];
    }
}
