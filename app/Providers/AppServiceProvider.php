<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

///added by me
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ///// adde by me
        Schema::defaultStringLength(191);
    }
}
