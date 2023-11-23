<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Externo extends Model
{
    use HasFactory;

    protected $table = 'externos';
    protected $primaryKey = 'usuario_id';
    protected $fillable = ['usuario_id'];
    public $timestamps = false;

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
