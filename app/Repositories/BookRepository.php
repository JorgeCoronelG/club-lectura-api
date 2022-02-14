<?php

namespace App\Repositories;

use App\Contracts\Repositories\IBookRepository;
use App\Core\BaseRepository;
use App\Models\Book;
use App\Models\Enums\StatusBook;
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

    public function findRecordsLatest(int $records = 10): Collection
    {
        return $this->entity
            ->selectRaw('id, title, status, image')
            ->whereIn('status', [StatusBook::Available, StatusBook::OnLoan])
            ->with('authors')
            ->latest()
            ->limit($records)
            ->get();
    }

    public function findMostRead(int $records = 10): Collection
    {
        return $this->entity
            ->selectRaw('id, title, status, image')
            ->whereIn('status', [StatusBook::Available, StatusBook::OnLoan])
            ->has('loans')
            ->withCount('loans')
            ->orderBy('loans_count', 'DESC')
            ->limit($records)
            ->get();
    }
}
