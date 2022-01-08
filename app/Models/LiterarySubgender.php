<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
