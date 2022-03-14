<?php

namespace App\Models\Dto;

use Spatie\DataTransferObject\DataTransferObject;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 14/03/2022
 */
class LiteraryGenderDTO extends DataTransferObject
{
    public ?int $id;

    public ?string $name;
}
