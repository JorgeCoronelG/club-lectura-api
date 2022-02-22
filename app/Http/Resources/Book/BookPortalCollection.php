<?php

namespace App\Http\Resources\Book;

use App\Http\Resources\Traits\PaginateCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookPortalCollection extends ResourceCollection
{
    use PaginateCollection;

    private bool $paginated;
    public $collects = BookPortalResource::class;

    public function __construct(mixed $resource, bool $paginated = false)
    {
        parent::__construct($resource);
        $this->paginated = $paginated;
    }

    /**
     * Transform the resource collection into an array.
     */
    public function toArray($request): array|\JsonSerializable|\Illuminate\Contracts\Support\Arrayable
    {
        return ($this->paginated)
            ? $this->getPaginationCollection($this)
            : ['data' => parent::toArray($request)];
    }
}
