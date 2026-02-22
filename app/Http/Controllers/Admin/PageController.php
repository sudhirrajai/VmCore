<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Http\Requests\Admin\PageRequest;
use App\Services\PageService;
use Mews\Purifier\Facades\Purifier;

class PageController extends Controller
{
    protected $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function index()
    {
        $pages = Page::orderBy('created_at', 'desc')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(PageRequest $request)
    {
        $data = $request->validated();

        if (isset($data['content'])) {
            $data['content'] = Purifier::clean($data['content']);
        }

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $filename = 'page_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $filename);
            $data['featured_image'] = 'uploads/pages/' . $filename;
        }

        if ($data['status'] === \App\Enums\StatusEnum::PUBLISHED->value && !isset($data['published_at'])) {
            $data['published_at'] = now();
        }

        Page::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(PageRequest $request, Page $page)
    {
        $data = $request->validated();

        if (isset($data['content'])) {
            $data['content'] = Purifier::clean($data['content']);
        }

        if ($request->hasFile('featured_image')) {
            if ($page->featured_image && file_exists(public_path($page->featured_image))) {
                @unlink(public_path($page->featured_image));
            }
            $file = $request->file('featured_image');
            $filename = 'page_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $filename);
            $data['featured_image'] = 'uploads/pages/' . $filename;
        }

        if ($data['status'] === \App\Enums\StatusEnum::PUBLISHED->value && !$page->published_at) {
            $data['published_at'] = now();
        }

        $page->update($data);

        $this->pageService->clearCache($page->slug);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $this->pageService->clearCache($page->slug);
        if ($page->featured_image && file_exists(public_path($page->featured_image))) {
            @unlink(public_path($page->featured_image));
        }
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
