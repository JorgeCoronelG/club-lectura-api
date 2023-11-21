<?php

namespace App\Http\Resources\Autor;

use App\Core\Traits\PaginateCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AutorCollection extends ResourceCollection
{
    use PaginateCollection;

    public $collects = AutorResource::class;

    public function __construct(
        mixed $resource,
        private bool $paginated = false
    ) {
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ($this->paginated)
            ? $this->getPaginationCollection($this)
            : parent::toArray($request);
    }
}
