<?php

namespace App\Providers;

use App\Http\Middleware\UpdateLastSeen;
use Illuminate\Contracts\Http\Kernel;

use Illuminate\Support\ServiceProvider;

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
    public function boot(Kernel $kernel): void
    {
        $kernel->appendMiddlewareToGroup('web', UpdateLastSeen::class);
    }
}
