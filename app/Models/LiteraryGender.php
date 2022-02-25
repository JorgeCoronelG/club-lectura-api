<?php

namespace App\Models;

use App\Models\Contracts\IScopeFilter;
use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LiteraryGender extends Model implements IScopeFilter
{
    use Sortable;

    protected $fillable = ['name'];

    public array $allowedSorts = [];

    public function literarySubgenders(): HasMany
    {
        return $this->hasMany(LiterarySubgender::class);
    }

    public function scopeFilter(Builder $query, array $params = []): Builder
    {
        return $query;
    }
}
