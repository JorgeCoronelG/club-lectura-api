<?php

namespace App\Http\Resources\Submenu;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubmenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this['id'],
            'pathRuta' => $this['path_ruta'],
            'etiqueta' => $this['etiqueta'],
            'orden' => $this['orden'],
            'menuId' => $this['menu_id']
        ];
    }
}
