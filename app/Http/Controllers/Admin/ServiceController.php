<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends AdminBaseController
{
    protected string $model = Service::class;
    protected string $viewPrefix = 'admin.content.services';
    protected string $routePrefix = 'admin.services';
    protected string $title = 'Service';

    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $items = $query->ordered()->paginate(10);

        return view('admin.content.services.index', compact('items'));
    }

    public function create()
    {
        return view('admin.content.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
            'status' => 'boolean',
            'order' => 'nullable|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        if ($path = $this->uploadImage($request, 'image', 'services')) {
            $data['image'] = $path;
        }

        if ($path = $this->uploadImage($request, 'banner_image', 'services/banners')) {
            $data['banner_image'] = $path;
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.content.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
            'status' => 'boolean',
            'order' => 'nullable|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        if ($path = $this->uploadImage($request, 'image', 'services')) {
            $this->deleteImage($service->image);
            $data['image'] = $path;
        }

        if ($path = $this->uploadImage($request, 'banner_image', 'services/banners')) {
            $this->deleteImage($service->banner_image);
            $data['banner_image'] = $path;
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $this->deleteImage($service->image);
        $this->deleteImage($service->banner_image);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
