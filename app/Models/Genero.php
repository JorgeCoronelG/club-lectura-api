<?php

namespace App\Models;

use App\Core\Traits\AdvancedFilter;
use App\Core\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genero extends Model
{
    use HasFactory, Sortable, AdvancedFilter;

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    protected $table = 'generos';
    protected $fillable = [
        'nombre'
    ];
    protected $casts = [
        'id' => 'integer'
    ];

    public array $allowedSorts = ['id', 'nombre'];

    public function libros(): HasMany
    {
        return $this->hasMany(Libro::class, 'generos');
    }
}
