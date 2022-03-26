<?php

namespace App\Contracts\Services;

use App\Core\Contracts\IBaseService;
use App\Models\Dto\UserDTO;
use App\Models\User;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 16/03/2022
 *
 * @method User create(UserDTO $dto)
 */
interface IUserService extends IBaseService
{
    //
}
