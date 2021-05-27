<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
        $this->registerInertia();
    }

    /**
     * Register inertia.
     */
    public function registerInertia()
    {
        Inertia::share([
            'auth' => function () {
            return [
                'user' => Auth::user() ? [
                'firstName' => Auth::user()->first_name,
                'email' => Auth::user()->email,
                'lastName' => Auth::user()->last_name,
                ] : null,
            ];
            },
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
