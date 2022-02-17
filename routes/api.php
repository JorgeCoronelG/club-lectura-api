<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::controller(AuthController::class)
        ->prefix('auth')
        ->name('auth')
        ->group(function () {
            Route::post('/login', 'login')->name('login');
        });

    Route::controller(BookController::class)
        ->prefix('books')
        ->name('books.')
        ->group(function () {
            Route::get('/portal/detail/{id}', 'findOnePortal')->name('find.one.portal');
            Route::get('/portal/latest', 'findLatest')->name('find.latest');
            Route::get('/portal/most-read', 'findMostRead')->name('find.most.read');
        });
});
