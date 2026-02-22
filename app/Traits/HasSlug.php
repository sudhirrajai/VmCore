<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $source = $model->title ?? $model->name ?? '';
                $model->slug = Str::slug($source);

                // Ensure unique slug
                $originalSlug = $model->slug;
                $count = 1;
                while (static::withTrashed()->where('slug', $model->slug)->exists()) {
                    $model->slug = $originalSlug . '-' . $count++;
                }
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title') || $model->isDirty('name')) {
                $source = $model->title ?? $model->name ?? '';
                $model->slug = Str::slug($source);

                $originalSlug = $model->slug;
                $count = 1;
                while (static::withTrashed()->where('slug', $model->slug)->where('id', '!=', $model->id)->exists()) {
                    $model->slug = $originalSlug . '-' . $count++;
                }
            }
        });
    }
}
