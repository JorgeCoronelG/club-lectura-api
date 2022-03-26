<?php

namespace App\Models\Dto;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 15/01/2022
 */
class UserDTO extends DataTransferObject
{
    public ?int $id;

    public ?string $code;

    #[MapTo('complete_name')]
    public ?string $completeName;

    public ?string $email;

    public ?string $password;

    public ?string $phone;

    public ?Carbon $birthday;

    public ?int $gender;

    public ?string $photo;

    public ?UploadedFile $photoFile;

    public ?int $status;

    public ?bool $verified;

    #[MapTo('verification_token')]
    public ?string $verificationToken;

    #[MapTo('email_verified_at')]
    public ?Carbon $emailVerifiedAt;

    #[CastWith(ArrayCaster::class, itemType: RoleDTO::class)]
    public ?array $roles;

    public ?int $type;

    public ?StudentDTO $studentDTO;

    public ?AcademicDTO $academicDTO;

    public ?ExternalDTO $externalDTO;
}
