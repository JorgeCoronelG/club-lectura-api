<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\IBaseRepository;
use App\Models\User;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 06/01/2022
 *
 * @method User create(array $data)
 * @method User update(int $id, array $data)
 * @method User findById(int $id)
 * @method User findRandom()
 */
interface IUserRepository extends IBaseRepository
{
    public function findByEmail(string $email): User;
}
