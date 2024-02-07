<?php

namespace App\Models;

use App\Core\Contracts\ScopeFilterInterface;
use App\Core\Traits\AdvancedFilter;
use App\Core\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable implements ScopeFilterInterface
{
    use HasApiTokens, HasFactory, Notifiable, Sortable, AdvancedFilter;

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    protected $table = 'usuarios';
    protected $fillable = [
        'nombre_completo',
        'correo',
        'contrasenia',
        'telefono',
        'fecha_nacimiento',
        'sexo_id',
        'estatus_id',
        'rol_id',
    ];
    protected $casts = [
        'id' => 'integer',
        'fecha_nacimiento' => 'date',
        'sexo_id' => 'integer',
        'estatus_id' => 'integer',
        'rol_id' => 'integer'
    ];
    protected $hidden = ['contrasenia'];
    public $allowedSorts = ['id', 'nombre_completo', 'correo', 'telefono', 'fecha_nacimiento'];

    public function sexo(): BelongsTo
    {
        return $this->belongsTo(CatalogoOpcion::class, 'sexo_id');
    }

    public function estatus(): BelongsTo
    {
        return $this->belongsTo(CatalogoOpcion::class, 'estatus_id');
    }

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function externo(): HasOne
    {
        return $this->hasOne(Externo::class, 'usuario_id');
    }

    public function escolar(): HasOne
    {
        return $this->hasOne(Escolar::class, 'usuario_id');
    }

    public function alumno(): HasONe
    {
        return $this->hasOne(Alumno::class, 'usuario_id');
    }

    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class, 'usuario_id');
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'menu_usuarios', 'usuario_id', 'menu_id');
    }

    public function submenus(): BelongsToMany
    {
        return $this->belongsToMany(Submenu::class, 'submenu_usuarios', 'usuario_id', 'submenu_id');
    }
}
