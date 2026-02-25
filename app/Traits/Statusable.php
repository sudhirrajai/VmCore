<?php

namespace App\Traits;

trait Statusable
{
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', false);
    }

    public function toggleStatus(): bool
    {
        $this->status = !$this->status;
        return $this->save();
    }

    public static function bootStatusable(): void
    {
        // Require active status globally ONLY when serving a frontend request
        // Excludes API routes, Admin routes, and CLI runs.
        if (!app()->runningInConsole() && !request()->is('admin*') && !request()->is('api*')) {
            static::addGlobalScope('active_status', function ($builder) {
                $builder->where('status', true);
            });
        }
    }
}
