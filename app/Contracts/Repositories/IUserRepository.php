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
 * @method User findRandom()
 * @method User findOneWithCondition(string $field, mixed $value, string $operator = '=' )
 */
interface IUserRepository extends IBaseRepository
{
    //
}
