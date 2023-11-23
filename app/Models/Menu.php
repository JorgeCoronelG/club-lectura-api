<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $fillable = [
        'path_ruta',
        'etiqueta',
        'icono',
        'orden',
        'estatus',
        'rol_id',
    ];
    protected $casts = [
        'id' => 'integer',
        'orden' => 'integer',
        'estatus' => 'boolean',
        'rol_id' => 'integer'
    ];
    public $timestamps = false;

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(Usuario::class, 'menu_usuarios', 'menu_id', 'usuario_id');
    }
}
