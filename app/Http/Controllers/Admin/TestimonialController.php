<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use App\Models\Project;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TestimonialController extends AdminBaseController
{
    protected string $model = Testimonial::class;
    protected string $title = 'Testimonial';

    public function index(Request $request)
    {
        $items = Testimonial::with('project', 'teamMember')->ordered()->paginate(request('per_page', 10));
        return view('admin.content.testimonials.index', compact('items'));
    }

    public function create()
    {
        $projects = Project::active()->ordered()->get();
        $teamMembers = TeamMember::active()->ordered()->get();
        return view('admin.content.testimonials.create', compact('projects', 'teamMembers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'rating' => 'integer|min:1|max:5',
            'project_id' => 'nullable|exists:projects,id',
            'team_member_id' => 'nullable|exists:team_members,id',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if ($path = $this->uploadImage($request, 'image', 'testimonials')) {
            $data['image'] = $path;
        }

        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        $projects = Project::active()->ordered()->get();
        $teamMembers = TeamMember::active()->ordered()->get();
        return view('admin.content.testimonials.edit', compact('testimonial', 'projects', 'teamMembers'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'rating' => 'integer|min:1|max:5',
            'project_id' => 'nullable|exists:projects,id',
            'team_member_id' => 'nullable|exists:team_members,id',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if ($path = $this->uploadImage($request, 'image', 'testimonials')) {
            $this->deleteImage($testimonial->image);
            $data['image'] = $path;
        }

        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $this->deleteImage($testimonial->image);
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
