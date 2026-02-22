<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\Orderable;
use App\Traits\Statusable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectCategory extends Model
{
    use HasFactory, SoftDeletes, HasSlug, Orderable, Statusable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'status',
        'order',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function getNameAttribute(): string
    {
        return $this->title;
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'category_id');
    }
}
