<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\BaseRepositoryInterface;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;

/**
 * @method Usuario create(array $data)
 * @method Usuario findById(int $id, array $columns = ['*'])
 * @method Usuario update(int $id, array $data)
 */
interface UsuarioRepositoryInterface extends BaseRepositoryInterface
{
    public function findByCorreo(string $correo): Usuario;

    public function findByField(string $field, string $value): ?Usuario;

    public function findAllForLoan(): Collection;
}
