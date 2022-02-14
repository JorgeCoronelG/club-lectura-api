<?php

namespace App\Http\Resources\LiteraryGender;

use Illuminate\Http\Resources\Json\JsonResource;

class LiteraryGenderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
