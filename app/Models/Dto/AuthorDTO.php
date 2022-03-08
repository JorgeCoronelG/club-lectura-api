<?php

namespace App\Models\Dto;

use Spatie\DataTransferObject\DataTransferObject;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 07/03/2022
 */
class AuthorDTO extends DataTransferObject
{
    public ?int $id;

    public ?string $name;
}
