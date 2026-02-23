<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'newsletter_id',
        'subscriber_id',
        'status',         // pending, sent, failed
        'error_message',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class, 'newsletter_id');
    }

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class, 'subscriber_id');
    }
}
