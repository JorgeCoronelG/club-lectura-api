<?php

namespace App\Core\Contracts;

/**
 * @author JorgeCoronelG
 * @version 1.0
 */
interface IReturnDto
{
    public function toDTO(): \Spatie\DataTransferObject\DataTransferObject;
}
