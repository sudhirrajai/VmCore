<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $table = 'newsletter_subscribers';

    protected $fillable = [
        'email',
        'name',
        'is_active',
        'unsubscribed_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'unsubscribed_at' => 'datetime',
    ];

    public function logs()
    {
        return $this->hasMany(NewsletterLog::class, 'subscriber_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
