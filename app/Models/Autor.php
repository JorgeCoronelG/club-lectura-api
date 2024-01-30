<?php

namespace App\Models;

use App\Core\Classes\Filter;
use App\Core\Contracts\ScopeFilterInterface;
use App\Core\Traits\AdvancedFilter;
use App\Core\Traits\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Autor extends Model implements ScopeFilterInterface
{
    use HasFactory, Sortable, AdvancedFilter;

    public const CREATED_AT =  'creado_en';
    public const UPDATED_AT = 'actualizado_en';

    protected $table = 'autores';
    protected $fillable = [
        'nombre'
    ];
    protected $casts = [
        'id' => 'integer'
    ];
    public array $allowedSorts = ['id', 'nombre'];

    public function libros(): BelongsToMany
    {
        return $this->belongsToMany(Libro::class, 'autores_libros', 'autor_id', 'libro_id');
    }

    /**
     * @param Builder $query
     * @param Filter[] $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $filters = []): Builder
    {
        foreach ($filters as $filter) {
            $this->filterAdvanced($query, $filter);
        }

        return $query;
    }
}
