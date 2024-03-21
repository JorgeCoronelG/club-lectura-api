<?php

namespace App\Http\Resources\Libro;

use App\Core\Traits\PaginateCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LibroCollection extends ResourceCollection
{
    use PaginateCollection;

    public $collects = LibroResource::class;

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
