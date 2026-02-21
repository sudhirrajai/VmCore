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
}
