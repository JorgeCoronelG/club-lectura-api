<?php

namespace App\Http\Resources\LiteraryGender;

use App\Http\Resources\LiterarySubgender\LiterarySubgenderResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LiteraryGenderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'literarySubgenders' => LiterarySubgenderResource::collection($this->whenLoaded('literarySubgenders'))
        ];
    }
}
