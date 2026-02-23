<?php

namespace App\Jobs;

use App\Mail\NewsletterMail;
use App\Models\Newsletter;
use App\Models\NewsletterLog;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $newsletter;

    /**
     * Create a new job instance.
     */
    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Mark as sending
        $this->newsletter->update(['status' => 'sending']);

        $totalSent = 0;

        Subscriber::where('is_active', true)->chunk(100, function ($subscribers) use (&$totalSent) {
            foreach ($subscribers as $subscriber) {
                // Prevent duplicate sending
                $logExists = NewsletterLog::where('newsletter_id', $this->newsletter->id)
                    ->where('subscriber_id', $subscriber->id)
                    ->whereIn('status', ['sent', 'pending'])
                    ->exists();

                if ($logExists) {
                    continue;
                }

                $log = NewsletterLog::create([
                    'newsletter_id' => $this->newsletter->id,
                    'subscriber_id' => $subscriber->id,
                    'status' => 'pending'
                ]);

                try {
                    Mail::to($subscriber->email)->queue(new NewsletterMail($this->newsletter, $subscriber));
                    $log->update([
                        'status' => 'sent',
                        'sent_at' => now()
                    ]);
                    $totalSent++;
                } catch (\Exception $e) {
                    $log->update([
                        'status' => 'failed',
                        'error_message' => $e->getMessage()
                    ]);
                    Log::error("Newsletter email failed for {$subscriber->email}: " . $e->getMessage());
                }
            }
        });

        // Finished
        $this->newsletter->update([
            'status' => 'sent',
            'sent_at' => now(),
            'total_recipients' => $totalSent
        ]);
    }
}
