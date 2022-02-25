<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookPortalController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::controller(AuthController::class)
        ->prefix('auth')
        ->name('auth')
        ->group(function () {
            Route::post('/login', 'login')->name('login');
        });

    Route::controller(BookPortalController::class)
        ->prefix('portal/books')
        ->name('books.portal.')
        ->group(function () {
            Route::get('', 'findAllPortal')->name('find.all');
            Route::get('/latest', 'findLatest')->name('find.latest');
            Route::get('/most-read', 'findMostRead')->name('find.most.read');
            Route::get('/detail/{id}', 'findOnePortal')->name('find.one')
                ->where('id', '[0-9]+');
        });
});
