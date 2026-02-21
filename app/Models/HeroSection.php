<?php

namespace App\Models;

use App\Traits\Orderable;
use App\Traits\Statusable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeroSection extends Model
{
    use HasFactory, SoftDeletes, Orderable, Statusable;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image',
        'button_text',
        'button_url',
        'address',
        'phone',
        'email',
        'status',
        'order',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
