<?php

namespace App\Contracts\Repositories;

use App\Core\Contracts\IBaseRepository;
use App\Models\User;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 06/01/2022
 */
interface IUserRepository extends IBaseRepository
{
    public function findByEmail(string $email): User;
}
