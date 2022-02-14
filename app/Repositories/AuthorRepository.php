<?php

namespace App\Repositories;

use App\Contracts\Repositories\IAuthorRepository;
use App\Core\BaseRepository;
use App\Models\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 08/01/2022
 */
class AuthorRepository extends BaseRepository implements IAuthorRepository
{
    protected Builder|Model $entity;

    /**
     * @param Author $author
     */
    public function __construct(Author $author)
    {
        $this->entity = $author;
    }
}
