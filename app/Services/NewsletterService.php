<?php

namespace App\Services;

use App\Models\Newsletter;
use App\Models\Subscriber;
use App\Jobs\SendNewsletterJob;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class NewsletterService
{
    public function createNewsletter(array $data, $user = null): Newsletter
    {
        $newsletter = new Newsletter();
        $newsletter->subject = $data['subject'];
        $newsletter->slug = Str::slug($data['subject']) . '-' . time();
        $newsletter->content = $data['content'];
        $newsletter->template_id = $data['template_id'] ?? null;
        $newsletter->created_by = $user ? $user->id : auth()->id();

        $action = $data['action'] ?? 'draft';

        if ($action === 'send_now') {
            $newsletter->status = 'sending';
            $newsletter->sent_at = now();
        } elseif ($action === 'schedule' && !empty($data['scheduled_at'])) {
            $newsletter->status = 'scheduled';
            $newsletter->scheduled_at = $data['scheduled_at'];
        } else {
            $newsletter->status = 'draft';
        }

        $newsletter->save();

        if ($action === 'send_now') {
            SendNewsletterJob::dispatch($newsletter);
        }

        return $newsletter;
    }

    public function updateNewsletter(Newsletter $newsletter, array $data): Newsletter
    {
        if (in_array($newsletter->status, ['sending', 'sent'])) {
            throw new \Exception("Cannot edit a newsletter that is sending or sent.");
        }

        $newsletter->subject = $data['subject'];
        $newsletter->content = $data['content'];
        $newsletter->template_id = $data['template_id'] ?? null;

        $action = $data['action'] ?? 'draft';

        if ($action === 'send_now') {
            $newsletter->status = 'sending';
            $newsletter->sent_at = now();
        } elseif ($action === 'schedule' && !empty($data['scheduled_at'])) {
            $newsletter->status = 'scheduled';
            $newsletter->scheduled_at = $data['scheduled_at'];
        } else {
            $newsletter->status = 'draft';
            $newsletter->scheduled_at = null;
        }

        $newsletter->save();

        if ($action === 'send_now') {
            SendNewsletterJob::dispatch($newsletter);
        }

        return $newsletter;
    }

    public function processUnsubscribe(string $email, string $token): bool
    {
        try {
            $subscriberId = Crypt::decryptString($token);
            $subscriber = Subscriber::where('email', $email)->where('id', $subscriberId)->first();

            if ($subscriber) {
                $subscriber->update([
                    'is_active' => false,
                    'unsubscribed_at' => now()
                ]);
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }
}
