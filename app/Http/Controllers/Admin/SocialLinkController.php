<?php

namespace App\Http\Controllers\Admin;

use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends AdminBaseController
{
    protected string $model = SocialLink::class;
    protected string $title = 'Social Link';

    public function index(Request $request)
    {
        $items = SocialLink::ordered()->paginate(10);
        return view('admin.content.social-links.index', compact('items'));
    }

    public function create()
    {
        return view('admin.content.social-links.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon_class' => 'nullable|string|max:255',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        SocialLink::create($data);
        return redirect()->route('admin.social-links.index')->with('success', 'Social link created successfully.');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.content.social-links.edit', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $data = $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon_class' => 'nullable|string|max:255',
            'status' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $socialLink->update($data);
        return redirect()->route('admin.social-links.index')->with('success', 'Social link updated successfully.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();
        return redirect()->route('admin.social-links.index')->with('success', 'Social link deleted successfully.');
    }
}
