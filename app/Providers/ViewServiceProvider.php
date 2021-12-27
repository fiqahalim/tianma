<?php

namespace App\Providers;

use App\Http\View\Composers\ProductPageComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        View::composer(
            'pages.product.list', 'App\Http\View\Composers\ProductPageComposer'
        );
    }
}
