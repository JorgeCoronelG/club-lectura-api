<?php

namespace App\Repositories;

use App\Contracts\Repositories\IUserRepository;
use App\Core\BaseRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 06/01/2022
 */
class UserRepository extends BaseRepository implements IUserRepository
{
    protected Builder|Model|QueryBuilder $entity;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function findByEmail(string $email): User
    {
        return $this->entity->where('email', $email)->firstOrFail();
    }

    public function findById(int $id): User
    {
        return $this->entity->with('roles')->findOrFail($id);
    }
}
