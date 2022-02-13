<?php

namespace App\Models\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface IScopeFilter
{
    public function scopeFilter(Builder $query, array $params = []): Builder;
}
