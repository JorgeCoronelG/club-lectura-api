<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AutorController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\UsuarioController;
use App\Models\Enum\RolEnum;

Route::controller(AuthController::class)
    ->prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::post('/login', 'login')->name('login');
        Route::patch('/restore-password', 'restorePassword')->name('restore-password');
    });

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::controller(AuthController::class)
            ->prefix('auth')
            ->name('auth.')
            ->group(function () {
               Route::get('/user', 'findUser')->name('users');
               Route::patch('/change-password', 'changePassword')->name('change-password');
            });

        Route::apiResource('autors',AutorController::class)
            ->middleware(
                'permission:'.
                RolEnum::ADMINISTRADOR->value.','.
                RolEnum::CAPTURISTA->value
            );

        Route::controller(MenuController::class)
            ->prefix('navigation')
            ->name('navigation.')
            ->group(function () {
                Route::get('/has-permission', 'hasPermissionToUrl')
                    ->name('has-permission')
                    ->middleware(
                        'permission:'.
                        RolEnum::ADMINISTRADOR->value.','.
                        RolEnum::CAPTURISTA->value.','.
                        RolEnum::LECTOR->value.','
                    );
            });

        Route::apiResource('users', UsuarioController::class)
            ->middleware(
                'permission:'
                .RolEnum::ADMINISTRADOR->value.','
                .RolEnum::CAPTURISTA->value
            );
    });
