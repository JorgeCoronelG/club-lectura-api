<?php

namespace App\Models\Dto;

use Spatie\DataTransferObject\DataTransferObject;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 16/03/2022
 */
class LiterarySubgenderDTO extends DataTransferObject
{
    public ?int $id;

    public ?string $name;

    public ?int $literary_gender_id;
}
