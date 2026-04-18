<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends AdminBaseController
{
    protected string $model = Client::class;
    protected string $title = 'Client';

    public function index(Request $request)
    {
        $items = Client::ordered()->paginate(request('per_page', 10));
        return view('admin.content.clients.index', compact('items'));
    }

    public function create()
    {
        return view('admin.content.clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'url' => 'nullable|url|max:255',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if ($path = $this->uploadImage($request, 'logo', 'clients')) {
            $data['logo'] = $path;
        }

        Client::create($data);
        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        return view('admin.content.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'url' => 'nullable|url|max:255',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if ($path = $this->uploadImage($request, 'logo', 'clients')) {
            $this->deleteImage($client->logo);
            $data['logo'] = $path;
        }

        $client->update($data);
        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $this->deleteImage($client->logo);
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully.');
    }
}
