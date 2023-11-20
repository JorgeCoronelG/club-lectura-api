<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;
use App\Models\Usuario;

/**
 * @method Usuario findById(int $id, array $columns = ['*'])
 */
interface UsuarioRepositoryInterface extends BaseRepositoryInterface
{
    public function buscarPorCorreo(string $correo): Usuario;
}
