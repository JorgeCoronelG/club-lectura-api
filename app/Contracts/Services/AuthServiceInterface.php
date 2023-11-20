<?php

namespace App\Contracts\Services;

use App\Core\Contracts\BaseServiceInterface;
use App\Models\Data\UsuarioData;
use App\Models\Usuario;
use Illuminate\Support\Collection;

interface AuthServiceInterface extends BaseServiceInterface
{
    public function login(UsuarioData $usuarioData): Collection;

    public function obtenerUsuario(int $id): Usuario;
}
