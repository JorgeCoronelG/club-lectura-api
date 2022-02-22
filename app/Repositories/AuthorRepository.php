<?php

namespace App\Repositories;

use App\Contracts\Repositories\IAuthorRepository;
use App\Core\BaseRepository;
use App\Models\Author;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 08/01/2022
 */
class AuthorRepository extends BaseRepository implements IAuthorRepository
{
    protected Builder|Model|QueryBuilder $entity;

    /**
     * @param Author $author
     */
    public function __construct(Author $author)
    {
        $this->entity = $author;
    }

    public function findAllByName(string $name): Collection
    {
        return $this->entity->where('name', 'LIKE', "%$name%")->get();
    }
}
