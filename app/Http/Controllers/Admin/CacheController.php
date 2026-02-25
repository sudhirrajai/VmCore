<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    public function clear()
    {
        // Clear all Laravel caches
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');

        // Also flush the in-memory cache directly
        Cache::flush();

        return back()->with('cache_cleared', '✅ All caches cleared successfully! Config, views, routes and application cache are refreshed.');
    }
}
