<?php

namespace App\Http\Resources\Auth;

use App\Helpers\Enum\Path;
use App\Helpers\File;
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
            'completeName' => $this->complete_name,
            'email' => $this->email,
            'photo' => File::getExposedPath(Path::USER_IMAGES->value, $this->photo),
            'roles' => RoleResource::collection($this->roles)
        ];
    }
}
