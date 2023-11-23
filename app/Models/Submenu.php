<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Submenu extends Model
{
    use HasFactory;

    protected $table = 'submenus';
    protected $fillable = [
        'path_ruta',
        'etiqueta',
        'orden',
        'menu_id',
        'estatus'
    ];
    protected $casts = [
        'id' => 'integer',
        'orden' => 'integer',
        'menu_id' => 'integer',
        'estatus' => 'boolean'
    ];
    public $timestamps = false;

    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(Usuario::class, 'submenu_usuarios', 'submenu_id', 'usuario_id');
    }
}
