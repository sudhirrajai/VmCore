<?php

namespace App\Models;

use App\Traits\Orderable;
use App\Traits\Statusable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class NavbarItem extends Model
{
    use HasFactory, SoftDeletes, Orderable, Statusable;

    protected $fillable = [
        'title',
        'url',
        'parent_id',
        'target',
        'status',
        'order',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(NavbarItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(NavbarItem::class, 'parent_id')->orderBy('order');
    }

    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }
}
