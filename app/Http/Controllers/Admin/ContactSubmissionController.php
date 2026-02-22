<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactSubmissionController extends AdminBaseController
{
    protected string $model = ContactSubmission::class;
    protected string $title = 'Contact Submission';

    public function index(Request $request)
    {
        $query = ContactSubmission::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('is_read', $request->status === 'read');
        }

        $items = $query->latest()->paginate(10);
        $unreadCount = ContactSubmission::unread()->count();

        return view('admin.content.inquiries.index', compact('items', 'unreadCount'));
    }

    public function show(ContactSubmission $inquiry)
    {
        $inquiry->markAsRead();
        return view('admin.content.inquiries.show', compact('inquiry'));
    }

    public function destroy(ContactSubmission $inquiry)
    {
        $inquiry->delete();
        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry deleted successfully.');
    }

    public function markAsRead(ContactSubmission $inquiry)
    {
        $inquiry->markAsRead();
        return back()->with('success', 'Marked as read.');
    }
}
