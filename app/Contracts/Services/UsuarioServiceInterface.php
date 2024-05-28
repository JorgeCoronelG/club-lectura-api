<?php

namespace App\Contracts\Services;

use App\Core\Contracts\BaseServiceInterface;
use App\Models\Dto\UsuarioDto;
use App\Models\Usuario;

/**
 * @method Usuario create(UsuarioDto $data)
 * @method Usuario update(int $id, UsuarioDto $data)
 */
interface UsuarioServiceInterface extends BaseServiceInterface
{
    public function createUserDonation(UsuarioDto $data): Usuario;
}
