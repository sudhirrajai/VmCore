<?php

namespace App\Models;

use App\Traits\Orderable;
use App\Traits\Statusable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes, Orderable, Statusable;

    protected $fillable = [
        'name',
        'logo',
        'url',
        'status',
        'order',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
