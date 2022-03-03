<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\Role\RoleResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * @param string $token
     */
    public function __construct(public string $token)
    {}

    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'token' => $this->token
        ];
    }
}
