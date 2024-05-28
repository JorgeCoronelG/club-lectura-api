<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonacionUsuario extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;

    protected $table = 'donaciones_usuarios';
    protected $fillable = ['donacion_id', 'usuario_id', 'referencia'];
}
