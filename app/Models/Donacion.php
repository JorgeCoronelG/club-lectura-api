<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Donacion extends Model
{
    use HasFactory;

    protected $table = 'donaciones';
    protected $fillable = [
        'codigo',
        'fecha_donacion'
    ];
    protected $casts = [
        'id' => 'integer',
        'fecha_donacion' => 'date'
    ];

    public function libro(): HasOne
    {
        return $this->hasOne(Libro::class, 'donacion_id');
    }

    public function libros(): BelongsToMany
    {
        return $this->belongsToMany(Libro::class, 'donaciones_usuarios', 'donacion_id', 'libro_id')
            ->withPivot(['referencia']);
    }
}
