<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
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
        // $categories = \App\Category::all(['name', 'slug']);       
        /**utilizei para enviar as categorias para o front - e poderia ser retido para todas as paginas
         * mas utilizei o composer
         */
        // view()->share('categories', $categories);

        // view()->composer(['welcome', 'single'], function($view)

        // view()->composer('*', function($view) use($categories){
        //     $view->with('categories', $categories);
        // });

        view()->composer('layouts.front', 'App\Http\Views\CategoryViewComposer@compose');
    }
}
