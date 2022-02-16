<?php

namespace App\Repositories;

use App\Contracts\Repositories\IBookRepository;
use App\Core\BaseRepository;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 08/01/2022
 */
class BookRepository extends BaseRepository implements IBookRepository
{
    protected Builder|Model $entity;

    /**
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->entity = $book;
    }

    public function findAllByStatus(array|int $status): Collection
    {
        return is_array($status)
            ? $this->entity->whereIn('status', $status)->get()
            : $this->entity->where('status', $status)->get();
    }
}
