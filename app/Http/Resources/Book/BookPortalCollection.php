<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookPortalCollection extends ResourceCollection
{
    public $collects = BookPortalResource::class;

    /**
     * Transform the resource collection into an array.
     */
    public function toArray($request)
    {
        return ['data' => parent::toArray($request)];
    }
}
