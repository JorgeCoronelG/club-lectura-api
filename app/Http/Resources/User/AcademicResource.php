<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class AcademicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'registration' => $this->registration,
            'type' => $this->type,
            'userId' => $this->user_id
        ];
    }
}
