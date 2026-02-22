<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use App\Models\Service;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProjectController extends AdminBaseController
{
    protected string $model = Project::class;
    protected string $viewPrefix = 'admin.content.projects';
    protected string $routePrefix = 'admin.projects';
    protected string $title = 'Project';

    public function index(Request $request)
    {
        $query = Project::with('category', 'service');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $items = $query->ordered()->paginate(10);
        $categories = ProjectCategory::active()->ordered()->get();

        return view('admin.content.projects.index', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = ProjectCategory::active()->ordered()->get();
        $services = Service::active()->ordered()->get();
        $tags = Tag::all();

        return view('admin.content.projects.create', compact('categories', 'services', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:project_categories,id',
            'service_id' => 'nullable|exists:services,id',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'project_date' => 'nullable|date',
            'project_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'status' => 'boolean',
            'order' => 'nullable|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'tags' => 'nullable|array',
            'gallery.*' => 'nullable|image|max:2048',
        ]);

        if ($path = $this->uploadImage($request, 'image', 'projects')) {
            $data['image'] = $path;
        }

        unset($data['tags'], $data['gallery']);
        $project = Project::create($data);

        // Sync tags
        if ($request->filled('tags')) {
            $tagIds = collect($request->tags)->map(function ($tagName) {
                return Tag::firstOrCreate(
                    ['slug' => \Illuminate\Support\Str::slug($tagName)],
                    ['title' => $tagName]
                )->id;
            });
            $project->tags()->sync($tagIds);
        }

        // Upload gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $file) {
                $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/projects/gallery'), $filename);
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => 'uploads/projects/gallery/' . $filename,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $project->load('tags', 'images');
        $categories = ProjectCategory::active()->ordered()->get();
        $services = Service::active()->ordered()->get();
        $tags = Tag::all();

        return view('admin.content.projects.edit', compact('project', 'categories', 'services', 'tags'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:project_categories,id',
            'service_id' => 'nullable|exists:services,id',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'project_date' => 'nullable|date',
            'project_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'status' => 'boolean',
            'order' => 'nullable|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'tags' => 'nullable|array',
            'gallery.*' => 'nullable|image|max:2048',
        ]);

        if ($path = $this->uploadImage($request, 'image', 'projects')) {
            $this->deleteImage($project->image);
            $data['image'] = $path;
        }

        unset($data['tags'], $data['gallery']);
        $project->update($data);

        // Sync tags
        if ($request->has('tags')) {
            $tagIds = collect($request->tags)->map(function ($tagName) {
                return Tag::firstOrCreate(
                    ['slug' => \Illuminate\Support\Str::slug($tagName)],
                    ['title' => $tagName]
                )->id;
            });
            $project->tags()->sync($tagIds);
        } else {
            $project->tags()->detach();
        }

        // Upload additional gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $file) {
                $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/projects/gallery'), $filename);
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => 'uploads/projects/gallery/' . $filename,
                    'order' => $project->images()->count() + $index,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->deleteImage($project->image);
        foreach ($project->images as $img) {
            $this->deleteImage($img->image);
        }
        $project->tags()->detach();
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    public function deleteGalleryImage($id)
    {
        $image = ProjectImage::findOrFail($id);
        $this->deleteImage($image->image);
        $image->delete();

        return response()->json(['success' => true, 'message' => 'Image deleted.']);
    }
}
