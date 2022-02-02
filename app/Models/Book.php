<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

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

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class)->withTimestamps();
    }

    public function loans(): BelongsToMany
    {
        return $this->belongsToMany(Loan::class)->withTimestamps();
    }
}
