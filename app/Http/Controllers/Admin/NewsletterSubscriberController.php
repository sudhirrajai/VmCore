<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use App\Http\Requests\StoreNewsletterSubscriberRequest;
use App\Http\Requests\UpdateNewsletterSubscriberRequest;
use Illuminate\Http\Request;

class NewsletterSubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->paginate(request('per_page', 20));
        return view('admin.newsletter.subscribers.index', compact('subscribers'));
    }

    public function create()
    {
        return view('admin.newsletter.subscribers.create');
    }

    public function store(StoreNewsletterSubscriberRequest $request)
    {
        Subscriber::create($request->validated());
        return redirect()->route('admin.newsletter.subscribers.index')->with('success', 'Subscriber added successfully.');
    }

    public function edit(Subscriber $subscriber)
    {
        return view('admin.newsletter.subscribers.edit', compact('subscriber'));
    }

    public function update(UpdateNewsletterSubscriberRequest $request, Subscriber $subscriber)
    {
        $subscriber->update($request->validated());
        return redirect()->route('admin.newsletter.subscribers.index')->with('success', 'Subscriber updated successfully.');
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();
        return redirect()->route('admin.newsletter.subscribers.index')->with('success', 'Subscriber deleted successfully.');
    }

    public function importForm()
    {
        return view('admin.newsletter.subscribers.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $csvData = file_get_contents($file);
        $rows = array_map("str_getcsv", explode("\n", $csvData));
        $header = array_shift($rows);

        $imported = 0;
        foreach ($rows as $row) {
            if (count($row) < 1 || empty($row[0]))
                continue;

            // Assume format: email, name
            $email = trim($row[0]);
            $name = isset($row[1]) ? trim($row[1]) : null;

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Subscriber::firstOrCreate(['email' => $email], [
                    'name' => $name,
                    'is_active' => true
                ]);
                $imported++;
            }
        }

        return redirect()->route('admin.newsletter.subscribers.index')->with('success', "$imported subscribers imported successfully.");
    }
}
