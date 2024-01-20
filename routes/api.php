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
               Route::get('/user', 'findUser')->name('find-user');
               Route::get('/logout', 'logout')->name('logout');

               Route::patch('/change-password', 'changePassword')->name('change-password');
            });

        Route::apiResource('autors',AutorController::class)
            ->middleware(
                'permission:'.
                RolEnum::ADMINISTRADOR->value.','.
                RolEnum::CAPTURISTA->value
            );

        Route::controller(MenuController::class)
            ->middleware(
                'permission:'.
                RolEnum::ADMINISTRADOR->value.','.
                RolEnum::CAPTURISTA->value.','.
                RolEnum::LECTOR->value.','
            )
            ->prefix('navigation')
            ->name('navigation.')
            ->group(function () {
                Route::get('/has-permission', 'hasPermissionToUrl')->name('has-permission');
                Route::get('/navigation', 'getNavigationMenu')->name('navigation');
            });

        Route::apiResource('users', UsuarioController::class)
            ->middleware(
                'permission:'
                .RolEnum::ADMINISTRADOR->value.','
                .RolEnum::CAPTURISTA->value
            );
    });
