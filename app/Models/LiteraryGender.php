<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LiteraryGender extends Model
{
    protected $fillable = ['name'];

    public function literarySubgender(): HasOne
    {
        return $this->hasOne(LiterarySubgender::class);
    }
}
