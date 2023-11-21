<?php

namespace App\Models;

use App\Core\Contracts\ScopeFilterInterface;
use App\Core\Traits\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Autor extends Model implements ScopeFilterInterface
{
    use HasFactory, Sortable;

    public const CREATED_AT =  'creado_en';
    public const UPDATED_AT = 'actualizado_en';

    protected $table = 'autores';
    protected $fillable = [
        'nombre'
    ];
    protected $casts = [
        'id' => 'integer'
    ];
    public $allowedSorts = ['id', 'nombre'];

    public function libros(): BelongsToMany
    {
        return $this->belongsToMany(Libro::class, 'autores_libros', 'autor_id', 'libro_id');
    }

    public function scopeFilter(Builder $query, array $params = []): Builder
    {
        if (empty($params)) {
            return $query;
        }

        if (isset($params['nombre']) && trim($params['nombre']) !== '') {
            $query->orWhere('nombre', 'LIKE', "%{$params['nombre']}%");
        }

        return $query;
    }
}
