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

        $items = $query->ordered()->paginate(request('per_page', 10));
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
            'dynamic_content' => 'nullable|string',
            'problem_solution' => 'nullable|array',
            'features' => 'nullable|array',
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
            'faq_schema_script' => 'nullable|string',
            'tags' => 'nullable|array',
            'new_gallery' => 'nullable|array',
            'new_gallery.*.image' => 'nullable|image|max:4096',
            'new_gallery.*.thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($path = $this->uploadImage($request, 'image', 'projects')) {
            $data['image'] = $path;
        }

        if ($path = $this->uploadImage($request, 'banner_image', 'projects/banners')) {
            $data['banner_image'] = $path;
        }

        unset($data['tags'], $data['new_gallery'], $data['categories'], $data['services']);
        if (isset($data['problem_solution'])) {
            $data['problem_solution'] = array_values(array_filter($data['problem_solution'], fn($item) => !empty($item['title'])));
        }
        if (isset($data['features'])) {
            $data['features'] = array_values(array_filter($data['features'], fn($item) => !empty($item['title'])));
        }

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
        $newGalleryFiles = $request->file('new_gallery') ?? [];
        $newGalleryData = $request->input('new_gallery') ?? [];
        $allNewIndices = array_unique(array_merge(array_keys($newGalleryFiles), array_keys($newGalleryData)));

        foreach ($allNewIndices as $index) {
            if (isset($newGalleryFiles[$index]['image'])) {
                $imageFile = $newGalleryFiles[$index]['image'];
                $imageFilename = time() . '_img_' . $index . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('uploads/projects/gallery'), $imageFilename);
                $imagePath = 'uploads/projects/gallery/' . $imageFilename;
                
                $thumbPath = null;
                if (isset($newGalleryFiles[$index]['thumbnail'])) {
                    $thumbFile = $newGalleryFiles[$index]['thumbnail'];
                    $thumbFilename = time() . '_thumb_' . $index . '.' . $thumbFile->getClientOriginalExtension();
                    $thumbFile->move(public_path('uploads/projects/gallery/thumbnails'), $thumbFilename);
                    $thumbPath = 'uploads/projects/gallery/thumbnails/' . $thumbFilename;
                } else {
                    $thumbDir = public_path('uploads/projects/gallery/thumbnails');
                    if (!file_exists($thumbDir)) {
                        mkdir($thumbDir, 0777, true);
                    }
                    $thumbFilename = 'thumb_' . basename($imagePath);
                    if ($this->createThumbnail(public_path($imagePath), $thumbDir . '/' . $thumbFilename)) {
                        $thumbPath = 'uploads/projects/gallery/thumbnails/' . $thumbFilename;
                    }
                }

                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => $imagePath,
                    'thumbnail' => $thumbPath,
                    'order' => $newGalleryData[$index]['order'] ?? 0,
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
            'dynamic_content' => 'nullable|string',
            'problem_solution' => 'nullable|array',
            'features' => 'nullable|array',
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
            'faq_schema_script' => 'nullable|string',
            'tags' => 'nullable|array',
            'new_gallery' => 'nullable|array',
            'new_gallery.*.image' => 'nullable|image|max:4096',
            'new_gallery.*.thumbnail' => 'nullable|image|max:2048',
            'existing_gallery' => 'nullable|array',
            'existing_gallery.*.image' => 'nullable|image|max:4096',
            'existing_gallery.*.thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($path = $this->uploadImage($request, 'image', 'projects')) {
            $this->deleteImage($project->image);
            $data['image'] = $path;
        }

        if ($path = $this->uploadImage($request, 'banner_image', 'projects/banners')) {
            $this->deleteImage($project->banner_image);
            $data['banner_image'] = $path;
        }

        unset($data['tags'], $data['new_gallery'], $data['existing_gallery'], $data['categories'], $data['services']);
        
        if (isset($data['problem_solution'])) {
            $data['problem_solution'] = array_values(array_filter($data['problem_solution'], fn($item) => !empty($item['title'])));
        }
        if (isset($data['features'])) {
            $data['features'] = array_values(array_filter($data['features'], fn($item) => !empty($item['title'])));
        }

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

        // Update existing gallery images
        $existingGalleryFiles = $request->file('existing_gallery') ?? [];
        $existingGalleryData = $request->input('existing_gallery') ?? [];
        $allExistingIds = array_unique(array_merge(array_keys($existingGalleryFiles), array_keys($existingGalleryData)));

        foreach ($allExistingIds as $id) {
            $projectImage = ProjectImage::find($id);
            if ($projectImage) {
                if (isset($existingGalleryData[$id]['order'])) {
                    $projectImage->order = $existingGalleryData[$id]['order'];
                }

                $newImageUploaded = false;
                $imagePath = $projectImage->image;

                if (isset($existingGalleryFiles[$id]['image'])) {
                    $this->deleteImage($projectImage->image);
                    $imageFile = $existingGalleryFiles[$id]['image'];
                    $imageFilename = time() . '_img_upd_' . $id . '.' . $imageFile->getClientOriginalExtension();
                    $imageFile->move(public_path('uploads/projects/gallery'), $imageFilename);
                    $imagePath = 'uploads/projects/gallery/' . $imageFilename;
                    $projectImage->image = $imagePath;
                    $newImageUploaded = true;
                }
                if (isset($existingGalleryFiles[$id]['thumbnail'])) {
                    if ($projectImage->thumbnail) {
                        $this->deleteImage($projectImage->thumbnail);
                    }
                    $thumbFile = $existingGalleryFiles[$id]['thumbnail'];
                    $thumbFilename = time() . '_thumb_upd_' . $id . '.' . $thumbFile->getClientOriginalExtension();
                    $thumbFile->move(public_path('uploads/projects/gallery/thumbnails'), $thumbFilename);
                    $projectImage->thumbnail = 'uploads/projects/gallery/thumbnails/' . $thumbFilename;
                } elseif ($newImageUploaded) {
                    if ($projectImage->thumbnail) {
                        $this->deleteImage($projectImage->thumbnail);
                    }
                    $thumbDir = public_path('uploads/projects/gallery/thumbnails');
                    if (!file_exists($thumbDir)) {
                        mkdir($thumbDir, 0777, true);
                    }
                    $thumbFilename = 'thumb_' . basename($imagePath);
                    if ($this->createThumbnail(public_path($imagePath), $thumbDir . '/' . $thumbFilename)) {
                        $projectImage->thumbnail = 'uploads/projects/gallery/thumbnails/' . $thumbFilename;
                    }
                }
                $projectImage->save();
            }
        }

        // Upload additional new gallery images
        $newGalleryFiles = $request->file('new_gallery') ?? [];
        $newGalleryData = $request->input('new_gallery') ?? [];
        $allNewIndices = array_unique(array_merge(array_keys($newGalleryFiles), array_keys($newGalleryData)));

        foreach ($allNewIndices as $index) {
            if (isset($newGalleryFiles[$index]['image'])) {
                $imageFile = $newGalleryFiles[$index]['image'];
                $imageFilename = time() . '_img_' . $index . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('uploads/projects/gallery'), $imageFilename);
                $imagePath = 'uploads/projects/gallery/' . $imageFilename;
                
                $thumbPath = null;
                if (isset($newGalleryFiles[$index]['thumbnail'])) {
                    $thumbFile = $newGalleryFiles[$index]['thumbnail'];
                    $thumbFilename = time() . '_thumb_' . $index . '.' . $thumbFile->getClientOriginalExtension();
                    $thumbFile->move(public_path('uploads/projects/gallery/thumbnails'), $thumbFilename);
                    $thumbPath = 'uploads/projects/gallery/thumbnails/' . $thumbFilename;
                } else {
                    $thumbDir = public_path('uploads/projects/gallery/thumbnails');
                    if (!file_exists($thumbDir)) {
                        mkdir($thumbDir, 0777, true);
                    }
                    $thumbFilename = 'thumb_' . basename($imagePath);
                    if ($this->createThumbnail(public_path($imagePath), $thumbDir . '/' . $thumbFilename)) {
                        $thumbPath = 'uploads/projects/gallery/thumbnails/' . $thumbFilename;
                    }
                }

                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => $imagePath,
                    'thumbnail' => $thumbPath,
                    'order' => $newGalleryData[$index]['order'] ?? 0,
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
            if ($img->thumbnail) {
                $this->deleteImage($img->thumbnail);
            }
        }
        $project->tags()->detach();
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    public function deleteGalleryImage($id)
    {
        $image = ProjectImage::findOrFail($id);
        $this->deleteImage($image->image);
        if ($image->thumbnail) {
            $this->deleteImage($image->thumbnail);
        }
        $image->delete();

        return response()->json(['success' => true, 'message' => 'Image deleted.']);
    }

    protected function createThumbnail($sourcePath, $destinationPath, $maxWidth = 600, $maxHeight = 600)
    {
        if (!file_exists($sourcePath)) return false;
        
        list($origWidth, $origHeight, $type) = getimagesize($sourcePath);
        if (!$origWidth || !$origHeight) return false;

        $ratio = $origWidth / $origHeight;
        if ($maxWidth / $maxHeight > $ratio) {
            $maxWidth = $maxHeight * $ratio;
        } else {
            $maxHeight = $maxWidth / $ratio;
        }

        $image = null;
        switch ($type) {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($sourcePath);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($sourcePath);
                break;
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($sourcePath);
                break;
            case IMAGETYPE_WEBP:
                $image = imagecreatefromwebp($sourcePath);
                break;
        }

        if (!$image) return false;

        $thumbnail = imagecreatetruecolor((int)$maxWidth, (int)$maxHeight);

        if ($type == IMAGETYPE_PNG || $type == IMAGETYPE_WEBP) {
            imagealphablending($thumbnail, false);
            imagesavealpha($thumbnail, true);
            $transparent = imagecolorallocatealpha($thumbnail, 255, 255, 255, 127);
            imagefilledrectangle($thumbnail, 0, 0, (int)$maxWidth, (int)$maxHeight, $transparent);
        }

        imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, (int)$maxWidth, (int)$maxHeight, $origWidth, $origHeight);

        $success = false;
        switch ($type) {
            case IMAGETYPE_JPEG:
                $success = imagejpeg($thumbnail, $destinationPath, 85);
                break;
            case IMAGETYPE_PNG:
                $success = imagepng($thumbnail, $destinationPath, 8);
                break;
            case IMAGETYPE_GIF:
                $success = imagegif($thumbnail, $destinationPath);
                break;
            case IMAGETYPE_WEBP:
                $success = imagewebp($thumbnail, $destinationPath, 85);
                break;
        }

        imagedestroy($image);
        imagedestroy($thumbnail);

        return $success;
    }
}
