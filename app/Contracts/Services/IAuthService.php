<?php

namespace App\Contracts\Services;

use App\Core\Contracts\IBaseService;
use App\Models\User;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 14/01/2022
 */
interface IAuthService extends IBaseService
{
    public function login(string $email, string $password): string;

    public function restorePassword(string $email): void;
}
