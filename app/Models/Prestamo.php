<?php

namespace App\Models;

use App\Core\Traits\AdvancedFilter;
use App\Core\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Prestamo extends Model
{
    use HasFactory, Sortable, AdvancedFilter;

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    protected $table = 'prestamos';
    protected $fillable = [
        'fecha_prestamo',
        'fecha_entrega',
        'fecha_real_entrega',
        'usuario_id',
        'estatus_id',
    ];
    protected $casts = [
        'id' => 'integer',
        'fecha_prestamo' => 'date',
        'fecha_entrega' => 'date',
        'fecha_real_entrega' => 'date',
        'usuario_id' => 'integer',
        'estatus_id' => 'integer',
    ];

    public array $allowedSorts = ['id', 'fecha_prestamo', 'fecha_real_entrega'];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function libros(): BelongsToMany
    {
        return $this->belongsToMany(Libro::class, 'libros_prestamos', 'prestamo_id', 'libro_id')
            ->using(LibroPrestamo::class);
    }

    public function multa(): HasOne
    {
        return $this->hasOne(Multa::class, 'prestamo_id');
    }

    public function estatus(): BelongsTo
    {
        return $this->belongsTo(CatalogoOpcion::class, 'estatus_id');
    }
}
