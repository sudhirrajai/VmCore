<?php

namespace App\Traits;

trait Orderable
{
    public function scopeOrdered($query, string $direction = 'asc')
    {
        return $query->orderBy('order', $direction);
    }

    public static function getNextOrder(): int
    {
        return (static::max('order') ?? 0) + 1;
    }

    public static function bootOrderable(): void
    {
        static::creating(function ($model) {
            if ($model->order === 0 || $model->order === null) {
                $model->order = static::getNextOrder();
            }
        });
    }
}
