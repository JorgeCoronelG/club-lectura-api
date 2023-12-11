<?php

namespace App\Contracts\Services;

use App\Core\Contracts\BaseServiceInterface;
use App\Models\Usuario;

interface MenuServiceInterface extends BaseServiceInterface
{
    public function createDefaultMenu(Usuario $usuario): void;

    public function changeMenuByRol(Usuario $usuario): void;
}
