<?php

namespace App\Repositories;

use App\Contracts\Repositories\IRoleRepository;
use App\Core\BaseRepository;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 06/01/2022
 */
class RoleRepository extends BaseRepository implements IRoleRepository
{
    protected Builder|Model $entity;

    /**
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->entity = $role;
    }
}
