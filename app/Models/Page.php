<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'featured_image',
        'published_at',
        'faq_schema_script',
        'meta_robots',
    ];

    protected $casts = [
        'status' => \App\Enums\StatusEnum::class,
        'published_at' => 'datetime',
    ];
}
