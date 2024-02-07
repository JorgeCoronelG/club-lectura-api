<?php

namespace App\Models;

use App\Core\Traits\AdvancedFilter;
use App\Core\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rol extends Model
{
    use HasFactory, Sortable, AdvancedFilter;

    protected $table = 'roles';

    protected $fillable = [
        'nombre'
    ];
    protected $casts = [
        'id' => 'integer'
    ];

    public $allowedSorts = ['id', 'nombre'];

    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'rol_id');
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'rol_id');
    }
}
