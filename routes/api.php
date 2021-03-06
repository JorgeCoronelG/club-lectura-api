<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookPortalController;
use App\Http\Controllers\Api\LiteraryGenderController;
use App\Http\Controllers\Api\LiterarySubgenderController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::controller(AuthController::class)
        ->prefix('auth')
        ->name('auth')
        ->group(function () {
            Route::post('/login', 'login')->name('login');
            Route::post('/restore-password', 'restorePassword')->name('restore.password');
        });

    Route::controller(BookPortalController::class)
        ->prefix('portal/books')
        ->name('books.portal.')
        ->group(function () {
            Route::get('', 'findAllPortal')->name('find.all');
            Route::get('/min-max-pages', 'getMaxMinPages')->name('min.max');
            Route::get('/latest', 'findLatest')->name('find.latest');
            Route::get('/most-read', 'findMostRead')->name('find.most.read');
            Route::get('/detail/{id}', 'findOnePortal')->name('find.one')
                ->where('id', '[0-9]+');
        });

    Route::controller(LiteraryGenderController::class)
        ->prefix('literary-gender')
        ->name('literary-gender.')
        ->group(function () {
            Route::get('/find-all', 'findAll')->name('find.all');
        });

    // Rutas con autenticación
    Route::group(['middleware' => 'auth:sanctum'], function () {
       Route::controller(AuthController::class)
           ->prefix('auth')
           ->name('auth')
           ->group(function () {
               Route::get('/logout', 'logout')->name('logout');
               Route::get('/user', 'getUser')->name('user');
           });

       Route::apiResources([
           'authors' => AuthorController::class,
           'literary-genders' => LiteraryGenderController::class,
           'literary-subgenders' => LiterarySubgenderController::class
       ]);
    });
});
