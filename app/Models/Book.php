<?php

namespace App\Models;

use App\Models\Contracts\IScopeFilter;
use App\Models\Enums\StatusBook;
use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model implements IScopeFilter
{
    use HasFactory, Sortable;

    protected $fillable = [
        'isbn',
        'title',
        'review',
        'no_pages',
        'condition',
        'price',
        'edition',
        'image',
        'copy',
        'language',
        'status',
        'donation_id',
        'literary_subgender_id'
    ];

    public array $allowedSorts = ['title', 'created_at'];

    public function scopeFilter(Builder $query, array $params = []): Builder
    {
        if(empty($params)) {
            return $query;
        }

        if (isset($params['title']) && trim($params['title']) !== '') {
            $query->where('title', 'LIKE', "%${params['title']}%");
        }

        return $query;
    }

    public function scopeFilterPortal(Builder $query, array $params = []): Builder
    {
        $query->whereIn('status', [StatusBook::Available, StatusBook::OnLoan]);

        if(empty($params)) {
            return $query;
        }

        if (isset($params['language'])) {
            $query->whereIn('language', $params['language']);
        }
        if (isset($params['literarySubgender'])) {
            $query->whereIn('literary_subgender_id', $params['literarySubgender']);
        }
        if (isset($params['status'])) {
            $query->whereIn('status', $params['status']);
        }
        if (isset($params['noPageMin']) && isset($params['noPageMax'])) {
            $query->where('no_pages', '>=', $params['noPageMin'])
                ->where('no_pages', '<=', $params['noPageMax']);
        }

        return $query;
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class)->withTimestamps();
    }

    public function loans(): BelongsToMany
    {
        return $this->belongsToMany(Loan::class)->withTimestamps();
    }

    public function literarySubgender(): BelongsTo
    {
        return $this->belongsTo(LiterarySubgender::class);
    }
}
