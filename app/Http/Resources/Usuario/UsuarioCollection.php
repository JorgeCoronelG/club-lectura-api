<?php

namespace App\Http\Resources\Usuario;

use App\Core\Traits\PaginateCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UsuarioCollection extends ResourceCollection
{
    use PaginateCollection;

    public $collects = UsuarioResource::class;

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
