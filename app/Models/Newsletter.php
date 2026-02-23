<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'slug',
        'content',
        'template_id',
        'status',          // draft, scheduled, sending, sent, failed
        'scheduled_at',
        'sent_at',
        'total_recipients',
        'created_by',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    public function template()
    {
        return $this->belongsTo(NewsletterTemplate::class, 'template_id');
    }

    public function logs()
    {
        return $this->hasMany(NewsletterLog::class, 'newsletter_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
