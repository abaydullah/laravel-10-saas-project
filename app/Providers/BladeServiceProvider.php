<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::if('impersonate',function (){
            return session()->has('impersonate');
        });
        Blade::if('admin',function (){
            return auth()->user()->hasRole('admin');
        });
        Blade::if('subscribed',function (){
            return auth()->user()->HasSubsciption();
        });

        Blade::if('notsubscribed',function (){
            return !auth()->check() || auth()->user()->HasNotSubsciption();
        });

        Blade::if('subscriptioncancelled',function (){
            return auth()->user()->HasCanceled();
        });
        Blade::if('subscriptionnotcancelled',function (){
            return auth()->user()->HasNotCanceled();
        });
        Blade::if('teamsubscription',function (){
            return auth()->user()->HasTeamSubsciption();
        });
    }
}
