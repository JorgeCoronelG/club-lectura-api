<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Multa extends Model
{
    use HasFactory;

    protected $table = 'multas';
    protected $fillable = [
        'costo',
        'estatus_id',
        'prestamo_id'
    ];
    protected $casts = [
        'id' => 'integer',
        'costo' => 'float',
        'estatus_id' => 'integer',
        'prestamo_id' => 'integer'
    ];

    public function estatus(): BelongsTo
    {
        return $this->belongsTo(CatalogoOpcion::class, 'estatus_id');
    }

    public function prestamo(): BelongsTo
    {
        return $this->belongsTo(Prestamo::class, 'prestamo_id');
    }
}
