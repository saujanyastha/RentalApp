<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard'; // Make sure this is correct

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
        {
            // ...
            $this->routes(function () {
                // ...
                Route::middleware('web')
                    ->group(base_path('routes/web.php'));

                // THIS IS THE CRUCIAL LINE for your Laravel version
                Route::middleware('web')
                    ->group(base_path('routes/auth.php')); // <-- ENSURE THIS IS HERE
            });
        }
}