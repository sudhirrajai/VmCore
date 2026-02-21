<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends AdminBaseController
{
    protected string $model = BlogCategory::class;
    protected string $title = 'Blog Category';

    public function index(Request $request)
    {
        $items = BlogCategory::withCount('posts')->ordered()->paginate(10);
        return view('admin.content.blog-categories.index', compact('items'));
    }

    public function create()
    {
        return view('admin.content.blog-categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        BlogCategory::create($data);
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(BlogCategory $blogCategory)
    {
        return view('admin.content.blog-categories.edit', ['category' => $blogCategory]);
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $blogCategory->update($data);
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category deleted successfully.');
    }
}
