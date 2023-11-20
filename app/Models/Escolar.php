<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Escolar extends Model
{
    use HasFactory;

    protected $table = 'escolares';
    protected $fillable = [
        'usuario_id',
        'matricula',
        'tipo_id'
    ];
    public $timestamps = false;

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function tipo(): BelongsTo
    {
        return $this->belongsTo(Escolar::class, 'tipo_id');
    }
}
