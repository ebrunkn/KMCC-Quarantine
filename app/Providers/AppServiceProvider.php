<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Model\Requirement;

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
        view()->composer('*', function($view){
            $total = Requirement::unread()->count();
            $view->with('unread_requests', $total);
        });
    }
}
