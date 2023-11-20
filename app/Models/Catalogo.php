<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Catalogo extends Model
{
    use HasFactory;

    protected $table = 'catalogos';
    protected $fillable = [
        'nombre'
    ];
    protected $casts = [
        'id' => 'integer'
    ];

    public function catalogoOpciones(): HasMany
    {
        return $this->hasMany(CatalogoOpcion::class, 'catalogo_id');
    }
}
