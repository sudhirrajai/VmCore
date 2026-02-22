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
