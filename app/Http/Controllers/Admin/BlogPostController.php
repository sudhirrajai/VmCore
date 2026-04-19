<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends AdminBaseController
{
    protected string $model = BlogPost::class;
    protected string $viewPrefix = 'admin.content.blog';
    protected string $routePrefix = 'admin.blog';
    protected string $title = 'Blog Post';

    public function index(Request $request)
    {
        $query = BlogPost::with('category', 'author');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $items = $query->latest()->paginate(request('per_page', 10));
        $categories = BlogCategory::active()->ordered()->get();

        return view('admin.content.blog.index', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = BlogCategory::active()->ordered()->get();
        $tags = Tag::all();

        return view('admin.content.blog.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:blog_categories,id',
            'excerpt' => 'nullable|string',
            'body' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'status' => 'boolean',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'faq_schema_script' => 'nullable|string',
            'tags' => 'nullable|array',
        ]);

        $data['user_id'] = Auth::id();

        if ($path = $this->uploadImage($request, 'image', 'blog')) {
            $data['image'] = $path;
        }

        if ($path = $this->uploadImage($request, 'banner_image', 'blog/banners')) {
            $data['banner_image'] = $path;
        }

        unset($data['tags']);
        $post = BlogPost::create($data);

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
            $post->tags()->sync($tagIds);
        }

        return redirect()->route('admin.blog.index')->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blog)
    {
        $blog->load('tags');
        $categories = BlogCategory::active()->ordered()->get();
        $tags = Tag::all();

        return view('admin.content.blog.edit', [
            'post' => $blog,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function update(Request $request, BlogPost $blog)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:blog_categories,id',
            'excerpt' => 'nullable|string',
            'body' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'status' => 'boolean',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'faq_schema_script' => 'nullable|string',
            'tags' => 'nullable|array',
        ]);

        if ($path = $this->uploadImage($request, 'image', 'blog')) {
            $this->deleteImage($blog->image);
            $data['image'] = $path;
        }

        if ($path = $this->uploadImage($request, 'banner_image', 'blog/banners')) {
            $this->deleteImage($blog->banner_image);
            $data['banner_image'] = $path;
        }

        unset($data['tags']);
        $blog->update($data);

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
            $blog->tags()->sync($tagIds);
        } else {
            $blog->tags()->detach();
        }

        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blog)
    {
        $this->deleteImage($blog->image);
        $this->deleteImage($blog->banner_image);
        $blog->tags()->detach();
        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted successfully.');
    }
}
