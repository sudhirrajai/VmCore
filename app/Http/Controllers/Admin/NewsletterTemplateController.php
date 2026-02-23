<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterTemplate;
use App\Http\Requests\StoreNewsletterTemplateRequest;
use App\Http\Requests\UpdateNewsletterTemplateRequest;

class NewsletterTemplateController extends Controller
{
    public function index()
    {
        $templates = NewsletterTemplate::latest()->paginate(20);
        return view('admin.newsletter.templates.index', compact('templates'));
    }

    public function create()
    {
        return view('admin.newsletter.templates.create');
    }

    public function store(StoreNewsletterTemplateRequest $request)
    {
        NewsletterTemplate::create($request->validated());
        return redirect()->route('admin.newsletter.templates.index')->with('success', 'Template created successfully.');
    }

    public function edit(NewsletterTemplate $template)
    {
        return view('admin.newsletter.templates.edit', compact('template'));
    }

    public function update(UpdateNewsletterTemplateRequest $request, NewsletterTemplate $template)
    {
        $template->update($request->validated());
        return redirect()->route('admin.newsletter.templates.index')->with('success', 'Template updated successfully.');
    }

    public function destroy(NewsletterTemplate $template)
    {
        $template->delete();
        return redirect()->route('admin.newsletter.templates.index')->with('success', 'Template deleted successfully.');
    }
}
