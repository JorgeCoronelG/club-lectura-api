<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Libro extends Model
{
    use HasFactory;

    protected $table = 'libros';
    protected $fillable = [
        'clave',
        'isbn',
        'titulo',
        'resenia',
        'num_paginas',
        'estado_fisico_id',
        'precio',
        'edicion',
        'imagen',
        'num_copia',
        'idioma_id',
        'estatus_id',
        'donacion_id',
        'genero_id',
    ];
    protected $casts = [
        'id' => 'integer',
        'num_paginas' => 'integer',
        'estado_fisico_id' => 'integer',
        'precio' => 'float',
        'edicion' => 'integer',
        'num_copia' => 'integer',
        'idioma_id' => 'integer',
        'estatus_id' => 'integer',
        'donacion_id' => 'integer',
        'genero_id' => 'integer'
    ];

    public function estadoFisico(): BelongsTo
    {
        return $this->belongsTo(CatalogoOpcion::class, 'estado_fisico_id');
    }

    public function idioma(): BelongsTo
    {
        return $this->belongsTo(CatalogoOpcion::class, 'idioma_id');
    }

    public function estatus(): BelongsTo
    {
        return $this->belongsTo(CatalogoOpcion::class, 'estatus_id');
    }

    public function genero(): BelongsTo
    {
        return $this->belongsTo(Genero::class, 'genero_id');
    }

    public function donacion(): BelongsTo
    {
        return $this->belongsTo(Donacion::class, 'donacion_id');
    }

    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'autores_libros', 'libro_id', 'autor_id');
    }

    public function prestamos(): BelongsToMany
    {
        return $this->belongsToMany(Prestamo::class, 'libros_prestamos', 'libro_id', 'prestamo_id');
    }
}
