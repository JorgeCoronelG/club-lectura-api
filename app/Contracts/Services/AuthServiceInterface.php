<?php

namespace App\Contracts\Services;

use App\Models\Dto\UsuarioDto;
use App\Models\Usuario;
use Illuminate\Support\Collection;

interface AuthServiceInterface
{
    public function login(UsuarioDto $usuarioData): Collection;

    public function findUser(int $id): Usuario;

    public function restorePassword(UsuarioDto $usuarioData): void;

    public function changePassword(int $usuarioId, UsuarioDto $usuarioData): void;
}
