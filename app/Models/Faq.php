<?php

namespace App\Models;

use App\Traits\Orderable;
use App\Traits\Statusable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory, SoftDeletes, Orderable, Statusable;

    protected $fillable = [
        'question',
        'answer',
        'status',
        'order',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
