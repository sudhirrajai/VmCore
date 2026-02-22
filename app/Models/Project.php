<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\Orderable;
use App\Traits\Statusable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes, HasSlug, Orderable, Statusable;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'service_id',
        'short_description',
        'description',
        'client',
        'project_date',
        'project_url',
        'image',
        'is_featured',
        'status',
        'order',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_featured' => 'boolean',
        'project_date' => 'date',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('order');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }
}
