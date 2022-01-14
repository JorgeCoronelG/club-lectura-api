<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fine extends Model
{
    protected $fillable = [
        'cost',
        'status',
        'loan_id'
    ];

    public function loans(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }
}
