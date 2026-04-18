<?php

namespace App\Http\Controllers\Admin;

use App\Models\Award;
use Illuminate\Http\Request;

class AwardController extends AdminBaseController
{
    protected string $model = Award::class;
    protected string $title = 'Award';

    public function index(Request $request)
    {
        $items = Award::ordered()->paginate(request('per_page', 10));
        return view('admin.content.awards.index', compact('items'));
    }

    public function create()
    {
        return view('admin.content.awards.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'nullable|string|max:10',
            'tag' => 'nullable|string|max:255',
            'url' => 'nullable|url|max:255',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        Award::create($data);
        return redirect()->route('admin.awards.index')->with('success', 'Award created successfully.');
    }

    public function edit(Award $award)
    {
        return view('admin.content.awards.edit', compact('award'));
    }

    public function update(Request $request, Award $award)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'nullable|string|max:10',
            'tag' => 'nullable|string|max:255',
            'url' => 'nullable|url|max:255',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $award->update($data);
        return redirect()->route('admin.awards.index')->with('success', 'Award updated successfully.');
    }

    public function destroy(Award $award)
    {
        $award->delete();
        return redirect()->route('admin.awards.index')->with('success', 'Award deleted successfully.');
    }
}
