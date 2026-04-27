<?php

namespace App\Http\Controllers\Admin;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends AdminBaseController
{
    protected string $model = TeamMember::class;
    protected string $viewPrefix = 'admin.content.team';
    protected string $routePrefix = 'admin.team';
    protected string $title = 'Team Member';

    public function index(Request $request)
    {
        $query = TeamMember::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $items = $query->ordered()->paginate(request('per_page', 10));

        return view('admin.content.team.index', compact('items'));
    }

    public function create()
    {
        return view('admin.content.team.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'social_links' => 'nullable|array',
            'social_links.facebook' => 'nullable|url',
            'social_links.twitter' => 'nullable|url',
            'social_links.instagram' => 'nullable|url',
            'social_links.linkedin' => 'nullable|url',
            'status' => 'boolean',
            'order' => 'nullable|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_robots' => 'nullable|string',
        ]);

        if ($path = $this->uploadImage($request, 'image', 'team')) {
            $data['image'] = $path;
        }

        TeamMember::create($data);

        return redirect()->route('admin.team.index')->with('success', 'Team member created successfully.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.content.team.edit', ['member' => $team]);
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'social_links' => 'nullable|array',
            'social_links.facebook' => 'nullable|url',
            'social_links.twitter' => 'nullable|url',
            'social_links.instagram' => 'nullable|url',
            'social_links.linkedin' => 'nullable|url',
            'status' => 'boolean',
            'order' => 'nullable|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_robots' => 'nullable|string',
        ]);

        if ($path = $this->uploadImage($request, 'image', 'team')) {
            $this->deleteImage($team->image);
            $data['image'] = $path;
        }

        $team->update($data);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $team)
    {
        $this->deleteImage($team->image);
        $team->delete();

        return redirect()->route('admin.team.index')->with('success', 'Team member deleted successfully.');
    }
}
