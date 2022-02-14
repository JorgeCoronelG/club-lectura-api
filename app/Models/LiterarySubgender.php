<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LiterarySubgender extends Model
{
    protected $fillable = [
        'name',
        'literary_gender_id'
    ];

    public function literaryGender(): BelongsTo
    {
        return $this->belongsTo(LiteraryGender::class);
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
