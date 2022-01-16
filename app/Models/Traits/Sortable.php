<?php

namespace App\Models\Traits;

use App\Helpers\Enum\Message;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;

trait Sortable
{
    public function scopeApplySort(Builder $query, string $sort = null): Builder
    {
        if (is_null($sort)) {
            return $query;
        }

        $sortFields = explode(',', $sort);

        foreach ($sortFields as $sortField) {
            $direction = 'ASC';

            if (str_starts_with($sortField, '-')) {
                $direction = 'DESC';
                $sortField = substr($sortField, 1);
            }

            if (!array_key_exists($sortField, $this->allowedFields)) {
                throw new \Exception(Message::INVALID_QUERY_PARAMETER, Response::HTTP_BAD_REQUEST);
            }

            $query->orderBy($this->allowedFields[$sortField], $direction);
        }

        return $query;
    }
}
