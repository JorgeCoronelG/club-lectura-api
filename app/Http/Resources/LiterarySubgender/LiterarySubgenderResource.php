<?php

namespace App\Http\Resources\LiterarySubgender;

use App\Http\Resources\LiteraryGender\LiteraryGenderResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LiterarySubgenderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'literaryGender' => LiteraryGenderResource::make($this->whenLoaded('literaryGender'))
        ];
    }
}
