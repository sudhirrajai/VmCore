<?php

namespace App\Http\Controllers\Admin;

use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroSectionController extends AdminBaseController
{
    protected string $model = HeroSection::class;
    protected string $viewPrefix = 'admin.content.hero-sections';
    protected string $routePrefix = 'admin.hero-sections';
    protected string $title = 'Hero Section';

    public function index(Request $request)
    {
        $query = HeroSection::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $items = $query->ordered()->paginate(10);

        return view('admin.content.hero-sections.index', compact('items'));
    }

    public function create()
    {
        return view('admin.content.hero-sections.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'image' => 'nullable|image|max:2048',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if ($path = $this->uploadImage($request, 'image', 'hero')) {
            $data['image'] = $path;
        }

        HeroSection::create($data);

        return redirect()->route('admin.hero-sections.index')->with('success', 'Hero section created successfully.');
    }

    public function edit(HeroSection $heroSection)
    {
        return view('admin.content.hero-sections.edit', compact('heroSection'));
    }

    public function update(Request $request, HeroSection $heroSection)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'image' => 'nullable|image|max:2048',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if ($path = $this->uploadImage($request, 'image', 'hero')) {
            $this->deleteImage($heroSection->image);
            $data['image'] = $path;
        }

        $heroSection->update($data);

        return redirect()->route('admin.hero-sections.index')->with('success', 'Hero section updated successfully.');
    }

    public function destroy(HeroSection $heroSection)
    {
        $this->deleteImage($heroSection->image);
        $heroSection->delete();

        return redirect()->route('admin.hero-sections.index')->with('success', 'Hero section deleted successfully.');
    }
}
