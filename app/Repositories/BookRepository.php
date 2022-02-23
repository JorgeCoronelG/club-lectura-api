<?php

namespace App\Repositories;

use App\Contracts\Repositories\IBookRepository;
use App\Core\BaseRepository;
use App\Models\Book;
use App\Models\Enums\StatusBook;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @author jcgonzalez
 * @version 1.0
 * Created 08/01/2022
 */
class BookRepository extends BaseRepository implements IBookRepository
{
    protected Builder|Model|QueryBuilder $entity;

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

    public function findAllPortalPaginated(array $filters, int $limit, array $authorsId, string $sort = null,
        array $columns = ['*']): LengthAwarePaginator
    {
        if (!empty($authorsId)) {
            $this->entity = $this->entity
                ->whereHas('authors', function (Builder $query) use ($authorsId) {
                    $query->whereIn('author_id', $authorsId);
                });
        }
        return $this->entity
            ->with('authors')
            ->filterPortal($filters)
            ->applySort($sort)
            ->paginate($limit, $columns);
    }

    public function findByIdPortal(int $id): Book
    {
        return $this->entity->with(['authors', 'literarySubgender.literaryGender'])->findOrFail($id);
    }

    public function findByImage(String $img): Book|null
    {
        return $this->entity->where('image', $img)->first();
    }

    public function findRecordsLatest(int $records = 10): Collection
    {
        return $this->entity
            ->select('id', 'title', 'status', 'image')
            ->whereIn('status', [StatusBook::Available, StatusBook::OnLoan])
            ->with('authors')
            ->latest()
            ->limit($records)
            ->get();
    }

    public function findMostRead(int $records = 10): Collection
    {
        return $this->entity
            ->select('id', 'title', 'status', 'image')
            ->whereIn('status', [StatusBook::Available, StatusBook::OnLoan])
            ->with('authors')
            ->withCount('loans')
            ->orderBy('loans_count', 'DESC')
            ->limit($records)
            ->get();
    }
}
