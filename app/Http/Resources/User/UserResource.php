<?php

namespace App\Http\Resources\User;

use App\Helpers\Enum\Path;
use App\Helpers\File;
use App\Http\Resources\Role\RoleResource;
use Carbon\Carbon;
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
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'gender'=> $this->gender,
            'photo' => File::getExposedPath(Path::USER_IMAGES->value, $this->photo),
            'status' => $this->status,
            'verified' => $this->verified,
            'emailVerifiedAt' => isset($this->email_verified_at)
                ? 'Verificado '.Carbon::parse($this->email_verified_at)->diffForHumans(parts: 2)
                : 'No verificado',
            'roles' => RoleResource::collection($this->roles),
            'student' => StudentResource::make($this->whenLoaded('student')),
            'academic' => AcademicResource::make($this->whenLoaded('academic')),
            'external' => ExternalResource::make($this->whenLoaded('external'))
        ];
    }
}
