<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'group' => $this->group,
            'turn' => $this->turn,
            'userId' => $this->user_id
        ];
    }
}
