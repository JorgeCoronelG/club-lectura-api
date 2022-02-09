<?php

namespace App\Models\Dto;

use Spatie\DataTransferObject\DataTransferObject;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 15/01/2022
 */
class RoleDTO extends DataTransferObject
{
    public ?int $id;

    public ?string $name;
}
