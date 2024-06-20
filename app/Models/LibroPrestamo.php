<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LibroPrestamo extends Pivot
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;

    protected $table = 'libros_prestamos';
    protected $fillable = ['prestamo_id', 'libro_id'];
}
