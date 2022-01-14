<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan',
        'approximate_delivery',
        'user_id'
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class)->withTimestamps();
    }

    public function fines(): HasOne
    {
        return $this->hasOne(Loan::class);
    }
}
