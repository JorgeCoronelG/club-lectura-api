<?php

namespace App\Models;

use App\Models\Contracts\IScopeFilter;
use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LiterarySubgender extends Model implements IScopeFilter
{
    use Sortable;

    protected $fillable = [
        'name',
        'literary_gender_id'
    ];

    public array $allowedSorts = ['id', 'name'];

    public function scopeFilter(Builder $query, array $params = []): Builder
    {
        if (empty($params)) {
            return $query;
        }

        if (isset($params['name']) && trim($params['name']) !== '') {
            $query->where('name', 'LIKE', "%${params['name']}%");
        }

        return $query;
    }

    public function literaryGender(): BelongsTo
    {
        return $this->belongsTo(LiteraryGender::class);
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
