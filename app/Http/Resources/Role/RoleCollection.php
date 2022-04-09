<?php

namespace App\Http\Resources\Role;

use App\Http\Resources\Traits\PaginateCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleCollection extends ResourceCollection
{
    use PaginateCollection;

    private bool $paginated;
    public $collects = RoleResource::class;

    public function __construct(mixed $resource, bool $paginated = false)
    {
        parent::__construct($resource);
        $this->paginated = $paginated;
    }

    /**
     * Transform the resource collection into an array.
     */
    public function toArray($request): array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    {
        return ($this->paginated)
            ? $this->getPaginationCollection($this)
            : ['data' => parent::toArray($request)];
    }
}
