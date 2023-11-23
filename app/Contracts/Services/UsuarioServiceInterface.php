<?php

namespace App\Contracts\Services;

use App\Core\Contracts\BaseServiceInterface;
use App\Models\Data\UsuarioData;
use App\Models\Usuario;

/**
 * @method Usuario create(UsuarioData $data)
 */
interface UsuarioServiceInterface extends BaseServiceInterface
{
    //
}