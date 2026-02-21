<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectCategoryController extends AdminBaseController
{
    protected string $model = ProjectCategory::class;
    protected string $title = 'Project Category';

    public function index(Request $request)
    {
        $items = ProjectCategory::withCount('projects')->ordered()->paginate(10);
        return view('admin.content.project-categories.index', compact('items'));
    }

    public function create()
    {
        return view('admin.content.project-categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        ProjectCategory::create($data);
        return redirect()->route('admin.project-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(ProjectCategory $projectCategory)
    {
        return view('admin.content.project-categories.edit', ['category' => $projectCategory]);
    }

    public function update(Request $request, ProjectCategory $projectCategory)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $projectCategory->update($data);
        return redirect()->route('admin.project-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(ProjectCategory $projectCategory)
    {
        $projectCategory->delete();
        return redirect()->route('admin.project-categories.index')->with('success', 'Category deleted successfully.');
    }
}
