<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Traits\PaginateCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    use PaginateCollection;

    private bool $paginated;
    public $collects = UserResource::class;

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
