<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NewsletterController extends AdminBaseController
{
    protected string $model = NewsletterSubscriber::class;
    protected string $title = 'Newsletter Subscriber';

    public function index(Request $request)
    {
        $query = NewsletterSubscriber::query();

        if ($request->filled('search')) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }

        $items = $query->latest()->paginate(10);

        return view('admin.content.newsletter.index', compact('items'));
    }

    public function destroy(NewsletterSubscriber $newsletter)
    {
        $newsletter->delete();
        return redirect()->route('admin.newsletter.index')->with('success', 'Subscriber removed successfully.');
    }

    public function export(): StreamedResponse
    {
        $subscribers = NewsletterSubscriber::active()->get();

        return response()->streamDownload(function () use ($subscribers) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Email', 'Subscribed At', 'Status']);

            foreach ($subscribers as $sub) {
                fputcsv($handle, [
                    $sub->email,
                    $sub->subscribed_at?->format('Y-m-d H:i'),
                    $sub->status ? 'Active' : 'Inactive',
                ]);
            }
            fclose($handle);
        }, 'newsletter_subscribers_' . date('Y-m-d') . '.csv');
    }
}
