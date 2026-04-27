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
        'short_description',
        'description',
        'dynamic_content',
        'client',
        'project_date',
        'project_url',
        'image',
        'banner_image',
        'is_featured',
        'status',
        'order',
        'meta_title',
        'meta_description',
        'faq_schema_script',
        'problem_solution',
        'features',
        'meta_robots',
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_featured' => 'boolean',
        'project_date' => 'date',
        'problem_solution' => 'array',
        'features' => 'array',
    ];

    public function categories()
    {
        return $this->belongsToMany(ProjectCategory::class, 'project_category', 'project_id', 'category_id')->withTimestamps();
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'project_service')->withTimestamps();
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
