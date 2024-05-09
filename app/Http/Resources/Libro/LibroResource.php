<?php

namespace App\Http\Resources\Libro;

use App\Core\Enum\Path;
use App\Helpers\File;
use App\Http\Resources\Autor\AutorCollection;
use App\Http\Resources\CatalogoOpcion\CatalogoOpcionResource;
use App\Http\Resources\Genero\GeneroResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LibroResource extends JsonResource
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
            'clave' => $this->clave,
            'isbn' => $this->isbn,
            'titulo' => $this->titulo,
            'resenia' => $this->resenia,
            'numPaginas' => $this->num_paginas,
            'precio' => $this->precio,
            'edicion' => $this->edicion,
            'imagen' => File::getExposedPath(Path::BOOK_IMAGES->value.'/', $this->imagen),
            'numCopia' => $this->num_copia,
            'autores' => AutorCollection::make($this->whenLoaded('autores')),
            'estadoFisicoId' => $this->estado_fisico_id,
            'estadoFisico' => CatalogoOpcionResource::make($this->whenLoaded('estadoFisico')),
            'idiomaId' => $this->idioma_id,
            'idioma' => CatalogoOpcionResource::make($this->whenLoaded('idioma')),
            'estatusId' => $this->estatus_id,
            'estatus' => CatalogoOpcionResource::make($this->whenLoaded('estatus')),
            'generoId' => $this->genero_id,
            'genero' => GeneroResource::make($this->whenLoaded('genero')),
            'donacionId' => $this->donacion_id,
        ];
    }
}
