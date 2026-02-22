<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Register admin views path so content.* blade paths resolve
        view()->addLocation(resource_path('views/admin'));

        // ── Share global data with ALL frontend views ──────────
        View::composer('*', \App\Http\View\Composers\GlobalViewComposer::class);
    }
}
