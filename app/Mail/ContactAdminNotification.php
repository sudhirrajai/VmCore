<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\ContactSubmission;

class ContactAdminNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $submission;

    /**
     * Create a new message instance.
     */
    public function __construct(ContactSubmission $submission)
    {
        $this->submission = $submission;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Log the recipient for debugging (you can remove this after verification)
        $adminEmail = \App\Models\Setting::get('site_email') ?? config('mail.from.address');
        \Illuminate\Support\Facades\Log::info('Dispatching Admin Contact Notification to: ' . $adminEmail);

        return new Envelope(
            subject: 'New Contact Form Submission - ' . config('app.name'),
            replyTo: [
                new Address($this->submission->email, $this->submission->name),
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact_admin_notification',
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
