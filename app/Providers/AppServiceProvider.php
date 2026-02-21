<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Register admin views path so content.* blade paths resolve
        view()->addLocation(resource_path('views/admin'));

        // ── Share global data with ALL frontend views ──────────
        View::composer(['layouts.app', 'partials.*'], function ($view) {
            // Site settings as keyed array
            $settings = cache()->remember('site_settings', 3600, function () {
                try {
                    return \App\Models\Setting::pluck('value', 'key')->toArray();
                } catch (\Exception $e) {
                    return [];
                }
            });

            // Active social links
            $socialLinks = cache()->remember('social_links', 3600, function () {
                try {
                    return \App\Models\SocialLink::where('status', true)
                        ->orderBy('order')->get();
                } catch (\Exception $e) {
                    return collect();
                }
            });

            $view->with('siteSettings', $settings);
            $view->with('socialLinks', $socialLinks);
        });
    }
}
