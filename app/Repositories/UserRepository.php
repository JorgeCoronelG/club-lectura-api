<?php

namespace App\Repositories;

use App\Contracts\Repositories\IUserRepository;
use App\Core\BaseRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function findAllPaginated(array $filters, int $limit, string $sort = null, array $columns = ['*'] ): LengthAwarePaginator {
        return $this->entity
            ->filter($filters)
            ->with(['roles', 'student', 'academic', 'external'])
            ->applySort($sort)
            ->paginate($limit, $columns);
    }

    public function findById(int $id): User
    {
        return $this->entity->with(['roles', 'student', 'academic', 'external'])->findOrFail($id);
    }

    public function findByEmail(string $email): User
    {
        return $this->entity->where('email', $email)->firstOrFail();
    }
}
