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
        $query = Project::with('categories', 'services');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('project_categories.id', $request->category_id);
            });
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
            'categories' => 'nullable|array',
            'categories.*' => 'exists:project_categories,id',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'project_date' => 'nullable|date',
            'project_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
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

        if ($path = $this->uploadImage($request, 'banner_image', 'projects/banners')) {
            $data['banner_image'] = $path;
        }

        unset($data['tags'], $data['gallery'], $data['categories'], $data['services']);
        $project = Project::create($data);

        if ($request->has('categories')) {
            $project->categories()->sync($request->categories);
        }
        if ($request->has('services')) {
            $project->services()->sync($request->services);
        }

        // Sync tags
        if ($request->filled('tags')) {
            $tagIds = collect($request->tags)
                ->filter(fn($tagName) => !empty(trim($tagName)))
                ->map(function ($tagName) {
                    $tagName = trim($tagName);
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
        $project->load('tags', 'images', 'categories', 'services');
        $categories = ProjectCategory::active()->ordered()->get();
        $services = Service::active()->ordered()->get();
        $tags = Tag::all();

        return view('admin.content.projects.edit', compact('project', 'categories', 'services', 'tags'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:project_categories,id',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'project_date' => 'nullable|date',
            'project_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
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

        if ($path = $this->uploadImage($request, 'banner_image', 'projects/banners')) {
            $this->deleteImage($project->banner_image);
            $data['banner_image'] = $path;
        }

        unset($data['tags'], $data['gallery'], $data['categories'], $data['services']);
        $project->update($data);

        $project->categories()->sync($request->categories ?? []);
        $project->services()->sync($request->services ?? []);

        // Sync tags
        if ($request->has('tags')) {
            $tagIds = collect($request->tags)
                ->filter(fn($tagName) => !empty(trim($tagName)))
                ->map(function ($tagName) {
                    $tagName = trim($tagName);
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
        $this->deleteImage($project->banner_image);
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
