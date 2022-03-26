<?php

namespace App\Models\Dto;

use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 26/01/2022
 */
class ExternalDTO extends DataTransferObject
{
    #[MapTo('user_id')]
    public ?int $userId;
}
