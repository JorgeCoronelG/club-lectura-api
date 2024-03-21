<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CatalogoOpcion extends Model
{
    use HasFactory;

    protected $table = 'catalogo_opciones';
    protected $fillable = [
        'catalogo_id',
        'valor',
        'clase_css'
    ];
    protected $casts = [
        'id' => 'integer',
        'catalogo_id' => 'integer'
    ];

    public function catalogo(): BelongsTo
    {
        return $this->belongsTo(Catalogo::class, 'catalogo_id');
    }

    public function generoUsuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'sexo_id');
    }

    public function estatusUsuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'estatus_id');
    }

    public function tipoEscolares(): HasMany
    {
        return $this->hasMany(Escolar::class, 'tipo_id');
    }

    public function turnoAlumnos(): HasMany
    {
        return $this->hasMany(Alumno::class, 'turno_id');
    }

    public function estatusFisicoLibros(): HasMany
    {
        return $this->hasMany(Libro::class, 'estado_fisico_id');
    }

    public function idiomaLibros(): HasMany
    {
        return $this->hasMany(Libro::class, 'idioma-id');
    }

    public function estatusLibros(): HasMany
    {
        return $this->hasMany(Libro::class, 'estatus_id');
    }

    public function estatusMultas(): HasMany
    {
        return $this->hasMany(Multa::class, 'estatus_id');
    }
}
