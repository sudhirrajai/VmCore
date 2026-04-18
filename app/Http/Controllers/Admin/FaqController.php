<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends AdminBaseController
{
    protected string $model = Faq::class;
    protected string $title = 'FAQ';

    public function index(Request $request)
    {
        $items = Faq::ordered()->paginate(request('per_page', 10));
        return view('admin.content.faqs.index', compact('items'));
    }

    public function create()
    {
        return view('admin.content.faqs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        Faq::create($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.content.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $faq->update($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }
}
