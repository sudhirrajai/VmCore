<?php

namespace App\Mail;

use App\Models\Newsletter;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $newsletter;
    public $subscriber;
    public $unsubscribeLink;

    /**
     * Create a new message instance.
     */
    public function __construct(Newsletter $newsletter, Subscriber $subscriber)
    {
        $this->newsletter = $newsletter;
        $this->subscriber = $subscriber;
        $this->unsubscribeLink = url("/unsubscribe/" . urlencode($subscriber->email) . "/" . Crypt::encryptString($subscriber->id));
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->newsletter->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
