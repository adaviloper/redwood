<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
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
        Route::prefix('api')->group(base_path('routes/api.php'));
        Route::prefix('auth')->group(base_path('routes/auth.php'));
        Route::prefix('console')->group(base_path('routes/console.php'));
    }
}
