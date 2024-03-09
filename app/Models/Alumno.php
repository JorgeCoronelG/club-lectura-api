<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';
    protected $primaryKey = 'usuario_id';
    protected $fillable = [
        'usuario_id',
        'semestre',
        'carrera_id',
        'turno_id',
    ];
    public $timestamps = false;
    protected $casts = [
        'usuario_id' => 'integer',
        'semestre' => 'integer',
        'carrera_id' => 'integer',
        'turno_id' => 'integer',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function turno(): BelongsTo
    {
        return $this->belongsTo(CatalogoOpcion::class, 'turno_id');
    }

    public function carrera(): BelongsTo
    {
        return $this->belongsTo(CatalogoOpcion::class, 'carrera_id');
    }
}
