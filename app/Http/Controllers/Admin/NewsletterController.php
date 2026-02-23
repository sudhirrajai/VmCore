<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use App\Models\NewsletterTemplate;
use App\Http\Requests\StoreNewsletterRequest;
use App\Services\NewsletterService;
use App\Jobs\SendNewsletterJob;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    protected $newsletterService;

    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    public function index()
    {
        $newsletters = Newsletter::latest()->paginate(20);
        return view('admin.newsletter.newsletters.index', compact('newsletters'));
    }

    public function create()
    {
        $templates = NewsletterTemplate::all();
        return view('admin.newsletter.newsletters.create', compact('templates'));
    }

    public function store(StoreNewsletterRequest $request)
    {
        $this->newsletterService->createNewsletter($request->validated());
        return redirect()->route('admin.newsletter.newsletters.index')->with('success', 'Newsletter saved successfully.');
    }

    public function edit(Newsletter $newsletter)
    {
        if (in_array($newsletter->status, ['sending', 'sent'])) {
            return redirect()->route('admin.newsletter.newsletters.index')->with('error', 'Cannot edit a newsletter that is sending or sent.');
        }
        $templates = NewsletterTemplate::all();
        return view('admin.newsletter.newsletters.edit', compact('newsletter', 'templates'));
    }

    public function update(StoreNewsletterRequest $request, Newsletter $newsletter)
    {
        try {
            $this->newsletterService->updateNewsletter($newsletter, $request->validated());
            return redirect()->route('admin.newsletter.newsletters.index')->with('success', 'Newsletter updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Newsletter $newsletter)
    {
        if (in_array($newsletter->status, ['sending'])) {
            return redirect()->route('admin.newsletter.newsletters.index')->with('error', 'Cannot delete a newsletter currently sending.');
        }
        $newsletter->delete();
        return redirect()->route('admin.newsletter.newsletters.index')->with('success', 'Newsletter deleted successfully.');
    }

    public function history()
    {
        $newsletters = Newsletter::withCount([
            'logs as sent_count' => function ($query) {
                $query->where('status', 'sent');
            },
            'logs as failed_count' => function ($query) {
                $query->where('status', 'failed');
            }
        ])->latest()->paginate(20);

        return view('admin.newsletter.newsletters.history', compact('newsletters'));
    }

    public function report(Newsletter $newsletter)
    {
        $logs = $newsletter->logs()->with('subscriber')->paginate(50);
        return view('admin.newsletter.newsletters.report', compact('newsletter', 'logs'));
    }

    public function sendNow(Newsletter $newsletter)
    {
        if (in_array($newsletter->status, ['sending', 'sent'])) {
            return redirect()->back()->with('error', 'Newsletter is already sending or sent.');
        }

        $newsletter->update(['status' => 'sending', 'sent_at' => now()]);
        SendNewsletterJob::dispatch($newsletter);

        return redirect()->back()->with('success', 'Newsletter sending has started in the background.');
    }
}
