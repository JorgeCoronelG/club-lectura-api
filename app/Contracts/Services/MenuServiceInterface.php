<?php

namespace App\Contracts\Services;

use App\Core\Contracts\BaseServiceInterface;
use App\Models\Usuario;

interface MenuServiceInterface extends BaseServiceInterface
{
    public function crearMenuPorDefecto(Usuario $usuario): void;
}
