<?php

namespace App\Repositories;

use App\Contracts\Repositories\IAuthorRepository;
use App\Core\BaseRepository;
use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class AuthorRepository extends BaseRepository implements IAuthorRepository
{
    protected Model $entity;

    /**
     * @param Author $author
     */
    public function __construct(Author $author)
    {
        $this->entity = $author;
    }

    /**
     * @throws Throwable
     */
    public function findRandoms(int $rows = 1): Collection
    {
        return $this->findAll()->random($rows);
    }
}
