<?php

namespace App\Contracts\Services;

use App\Models\Data\UsuarioData;
use App\Models\Usuario;
use Illuminate\Support\Collection;

interface AuthServiceInterface
{
    public function login(UsuarioData $usuarioData): Collection;

    public function findUser(int $id): Usuario;

    public function restorePassword(UsuarioData $usuarioData): void;

    public function changePassword(int $usuarioId, UsuarioData $usuarioData): void;
}
