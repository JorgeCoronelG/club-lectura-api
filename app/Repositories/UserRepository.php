<?php

namespace App\Repositories;

use App\Contracts\Repositories\IUserRepository;
use App\Core\BaseRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 06/01/2022
 */
class UserRepository extends BaseRepository implements IUserRepository
{
    protected Model $entity;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->entity = $user;
    }
}
