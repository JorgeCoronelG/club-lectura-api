<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'paternalSurname' => $this->paternal_surname,
            'maternalSurname' => $this->maternal_surname,
            'email' => $this->email,
            'photo' => $this->photo,
            'roles' => RoleResource::collection($this->roles)
        ];
    }
}
