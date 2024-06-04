<?php /** @noinspection PhpArithmeticTypeCheckInspection */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AutorController;
use App\Http\Controllers\Api\CatalogoOpcionController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\RolController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\LibroController;
use App\Http\Controllers\Api\GeneroController;
use App\Http\Controllers\Api\DonationController;
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

        Route::controller(CatalogoOpcionController::class)
            ->prefix('options-catalog')
            ->name('options-catalog.')
            ->group(function () {
                Route::get('catalog-id/{catalogoId}', 'findByCatalogoId')->name('find-by-catalog-id');
            });

        Route::controller(GeneroController::class)
            ->prefix('genres')
            ->name('genres.')
            ->group(function () {
                Route::get('/find-all', 'findAll')->name('find-all');
            });

        Route::controller(LibroController::class)
            ->prefix('books')
            ->name('books.')
            ->group(function () {
                Route::patch('image/{id}', 'updateImage')->name('image');
            });

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
                Route::get('/user/{userId}', 'getNavigationByUserId')
                    ->name('user')
                    ->middleware('permission:'.RolEnum::ADMINISTRADOR->value);
                Route::put('/permission/{userId}', 'syncNavigation')
                    ->name('permission')
                    ->middleware('permission:'.RolEnum::ADMINISTRADOR->value);
            });

        Route::controller(RolController::class)
            ->middleware(
                'permission:'.
                RolEnum::ADMINISTRADOR->value.','.
                RolEnum::CAPTURISTA->value.','
            )
            ->prefix('roles')
            ->name('roles.')
            ->group(function () {
                Route::get('/find-all', 'findAll')->name('find-all');
            });

        Route::controller(UsuarioController::class)
            ->middleware('permission:'.
                RolEnum::ADMINISTRADOR->value.','.
                RolEnum::CAPTURISTA->value.','
            )
            ->prefix('users')
            ->name('users.')
            ->group(function () {
                Route::get('/find-all', 'findAll')->name('find-all');
            });

        /* API RESOURCES */

        Route::apiResource('authors',AutorController::class)
            ->middleware(
                'permission:'.
                RolEnum::ADMINISTRADOR->value.','.
                RolEnum::CAPTURISTA->value
            );

        Route::apiResource('books', LibroController::class)
            ->middleware(
                'permission:'.
                RolEnum::ADMINISTRADOR->value.','.
                RolEnum::CAPTURISTA->value.','
            );

        Route::apiResource('donations', DonationController::class)
            ->only('store')
            ->middleware(
                'permission:'.
                RolEnum::ADMINISTRADOR->value.','.
                RolEnum::CAPTURISTA->value.','
            );

        Route::apiResource('users', UsuarioController::class)
            ->middleware(
                'permission:'
                .RolEnum::ADMINISTRADOR->value.','
                .RolEnum::CAPTURISTA->value
            );
    });
