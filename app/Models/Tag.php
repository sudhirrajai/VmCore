<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['title', 'slug'];

    public function projects(): MorphToMany
    {
        return $this->morphedByMany(Project::class, 'taggable');
    }

    public function blogPosts(): MorphToMany
    {
        return $this->morphedByMany(BlogPost::class, 'taggable');
    }
}
