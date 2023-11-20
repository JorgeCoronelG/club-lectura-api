<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Prestamo extends Model
{
    use HasFactory;

    protected $table = 'prestamos';
    protected $fillable = [
        'fecha_prestamo',
        'fecha_real_entrega',
        'usuario_id',
    ];
    protected $casts = [
        'id' => 'integer',
        'fecha_prestamo' => 'date',
        'fecha_real_entrega' => 'date',
        'usuario_id' => 'integer'
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function libros(): BelongsToMany
    {
        return $this->belongsToMany(Libro::class, 'libros_prestamos', 'prestamo_id', 'libro_id');
    }

    public function multa(): HasOne
    {
        return $this->hasOne(Multa::class, 'prestamo_id');
    }
}
