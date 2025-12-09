<?php

namespace App\Providers;

use App\Models\Prescription;
use App\Observers\PrescriptionObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         // Register the observer
         Prescription::observe(PrescriptionObserver::class);
        //redirect an Authenticated user to dashboard
        RedirectIfAuthenticated::redirectUsing(function(){
            return route('admin.dashboard');
        });

        //Redirect no Authenticated user to admin login page
        Authenticate::redirectUsing(function(){
            Session::flash('fail','You must be logged in to access admin area. please login to continue');
            return route('admin.login');
        });
    }
}
