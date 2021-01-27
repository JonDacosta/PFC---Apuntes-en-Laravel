<?php

namespace App\Providers;

use View;
use App\Models\ModuloApunte;
use Illuminate\Support\ServiceProvider;

class ModulosProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {

            $modulos = ModuloApunte::all();
            $view->with('modulos', $modulos);
        });
    }
}
