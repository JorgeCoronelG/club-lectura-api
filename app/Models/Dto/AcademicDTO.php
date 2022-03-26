<?php

namespace App\Models\Dto;

use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 22/01/2022
 */
class AcademicDTO extends DataTransferObject
{
    #[MapTo('user_id')]
    public ?int $userId;

    public ?string $registration;

    public ?int $type;
}
