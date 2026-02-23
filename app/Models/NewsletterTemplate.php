<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'html_structure',
    ];

    public function newsletters()
    {
        return $this->hasMany(Newsletter::class, 'template_id');
    }
}
