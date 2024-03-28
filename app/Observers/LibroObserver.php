<?php

namespace App\Observers;

use App\Models\Libro;

class LibroObserver
{
    /**
     * Handle the Libro "created" event.
     */
    public function created(Libro $libro): void
    {
        $libro->clave = "L-$libro->id";
        $libro->save();
    }
}
