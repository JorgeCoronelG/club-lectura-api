<?php

namespace App\Http\Resources\Menu;

use App\Http\Resources\Submenu\SubmenuResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $pathRoute = count($this['submenu']) === 0 ? $this['path_ruta'] : null;

        return [
            'id' => $this['id'],
            'pathRuta' => $pathRoute,
            'etiqueta' => $this['etiqueta'],
            'icono' => $this['icono'],
            'orden' => $this['orden'],
            'submenu' => SubmenuResource::collection($this['submenu'])
        ];
    }
}
