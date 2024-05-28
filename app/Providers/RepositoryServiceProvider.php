<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public const INTERFACE_REPOSITORY_NAMESPACE = 'App\Contracts\Repositories\\';
    public const IMPLEMENT_REPOSITORY_NAMESPACE = 'App\Repositories\\';

    protected array $repositories = [
        'UsuarioRepositoryInterface' => 'UsuarioRepository',
        'AutorRepositoryInterface' => 'AutorRepository',
        'CatalogoOpcionRepositoryInterface' => 'CatalogoOpcionRepository',
        'MenuRepositoryInterface' => 'MenuRepository',
        'SubmenuRepositoryInterface' => 'SubmenuRepository',
        'RolRepositoryInterface' => 'RolRepository',
        'LibroRepositoryInterface' => 'LibroRepository',
        'GeneroRepositoryInterface' => 'GeneroRepository',
        'DonationRepositoryInterface' => 'DonationRepository',
        'DonacionUsuarioRepositoryInterface' => 'DonacionUsuarioRepository',
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind(self::INTERFACE_REPOSITORY_NAMESPACE.$interface,
                             self::IMPLEMENT_REPOSITORY_NAMESPACE.$implementation);
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
