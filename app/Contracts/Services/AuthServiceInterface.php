<?php

namespace App\Contracts\Services;

use App\Models\Data\UsuarioData;
use App\Models\Usuario;
use Illuminate\Support\Collection;

interface AuthServiceInterface
{
    public function login(UsuarioData $usuarioData): Collection;

    public function obtenerUsuario(int $id): Usuario;

    public function restablecerContrasenia(UsuarioData $usuarioData): void;
}
