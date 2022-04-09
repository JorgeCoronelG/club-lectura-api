<?php

namespace App\Models;

use App\Models\Contracts\IScopeFilter;
use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model implements IScopeFilter
{
    use HasFactory, Sortable;

    protected $fillable = ['name'];

    public array $allowedSorts = ['name'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function scopeFilter(Builder $query, array $params = []): Builder
    {
        return $query;
    }
}
