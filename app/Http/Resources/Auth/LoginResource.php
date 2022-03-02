<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\Role\RoleResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * @param User $user
     */
    public function __construct(public User $user)
    {}

    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->user->id,
            'code' => $this->user->code,
            'name' => $this->user->name,
            'paternalSurname' => $this->user->paternal_surname,
            'maternalSurname' => $this->user->maternal_surname,
            'email' => $this->user->email,
            'roles' => RoleResource::collection($this->user->roles),
            'token' => $this->user->token
        ];
    }
}
