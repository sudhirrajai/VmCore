<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends AdminBaseController
{
    protected string $model = Skill::class;
    protected string $title = 'Skill';

    public function index(Request $request)
    {
        $items = Skill::ordered()->paginate(10);
        return view('admin.content.skills.index', compact('items'));
    }

    public function create()
    {
        return view('admin.content.skills.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        Skill::create($data);
        return redirect()->route('admin.skills.index')->with('success', 'Skill created successfully.');
    }

    public function edit(Skill $skill)
    {
        return view('admin.content.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $skill->update($data);
        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully.');
    }
}
