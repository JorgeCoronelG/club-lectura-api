<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AutorController;
use App\Models\Enum\RolEnum;

Route::controller(AuthController::class)
    ->prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::post('/login', 'login')->name('login');
    });

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::controller(AuthController::class)
            ->prefix('auth')
            ->name('auth.')
            ->group(function () {
               Route::get('/usuario', 'obtenerUsuario')->name('usuario');
            });

        Route::apiResource('autores',AutorController::class)
            ->middleware(
                'permission:'
                .RolEnum::ADMINISTRADOR->value.','
                .RolEnum::CAPTURISTA->value
            );
    });
