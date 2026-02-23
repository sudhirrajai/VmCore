<?php

namespace App\Console\Commands;

use App\Jobs\SendNewsletterJob;
use App\Models\Newsletter;
use Illuminate\Console\Command;

class CheckScheduledNewsletters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and dispatch scheduled newsletters';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newsletters = Newsletter::where('status', 'scheduled')
            ->where('scheduled_at', '<=', now())
            ->get();

        $this->info("Found " . $newsletters->count() . " scheduled newsletters to send.");

        foreach ($newsletters as $newsletter) {
            $newsletter->update(['status' => 'sending']);
            SendNewsletterJob::dispatch($newsletter);
            $this->info("Dispatched newsletter ID: " . $newsletter->id);
        }
    }
}
