<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceLogicServiceProvider extends ServiceProvider
{
    public const INTERFACE_SERVICE_NAMESPACE = 'App\Contracts\Services\\';
    public const IMPLEMENT_SERVICE_NAMESPACE = 'App\Services\\';

    protected array $services = [
        'AuthServiceInterface' => 'AuthService',
        'AutorServiceInterface' => 'AutorService',
        'UsuarioServiceInterface' => 'UsuarioService',
        'MenuServiceInterface' => 'MenuService',
        'CatalogoOpcionServiceInterface' => 'CatalogoOpcionService',
        'RolServiceInterface' => 'RolService',
        'LibroServiceInterface' => 'LibroService',
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->services as $interface => $implementation) {
            $this->app->bind(self::INTERFACE_SERVICE_NAMESPACE.$interface,
                             self::IMPLEMENT_SERVICE_NAMESPACE.$implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
