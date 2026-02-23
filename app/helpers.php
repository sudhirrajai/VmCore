<?php

if (!function_exists('setting')) {
    /**
     * Get a setting value by key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting(string $key, $default = null)
    {
        if (app()->bound(\App\Services\SettingService::class)) {
            $service = app(\App\Services\SettingService::class);
            return $service->get($key, $default);
        }

        // Fallback if service isn't strictly loaded
        return \App\Models\Setting::where('key', $key)->value('value') ?? $default;
    }
}

if (!function_exists('google_setting')) {
    /**
     * Get a google setting value by key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function google_setting(string $key, $default = null)
    {
        return \App\Models\Setting::get($key, $default);
    }
}
