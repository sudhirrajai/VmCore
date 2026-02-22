<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Http\Requests\Admin\MenuRequest;
use App\Http\Requests\Admin\MenuItemRequest;
use App\Services\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        $menus = Menu::with('parent_items')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function store(MenuRequest $request)
    {
        Menu::create($request->validated());
        $this->menuService->clearCache();
        return redirect()->route('admin.menus.index')->with('success', 'Menu created successfully.');
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        $menu->update($request->validated());
        $this->menuService->clearCache();
        return redirect()->route('admin.menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        $this->menuService->clearCache();
        return redirect()->route('admin.menus.index')->with('success', 'Menu deleted successfully.');
    }

    public function items(Menu $menu)
    {
        $menu->load(['parent_items.children']);
        $pages = \App\Models\Page::where('status', \App\Enums\StatusEnum::PUBLISHED)->get();
        return view('admin.menus.builder', compact('menu', 'pages'));
    }

    public function storeItem(MenuItemRequest $request, Menu $menu)
    {
        $data = $request->validated();
        $data['menu_id'] = $menu->id;
        $data['parent_id'] = $data['parent_id'] ?? null;
        $data['sort_order'] = MenuItem::where('menu_id', $menu->id)->where('parent_id', $data['parent_id'])->max('sort_order') + 1;

        MenuItem::create($data);
        $this->menuService->clearCache();

        return back()->with('success', 'Item added.');
    }

    public function destroyItem(MenuItem $item)
    {
        $item->delete();
        $this->menuService->clearCache();
        return back()->with('success', 'Item deleted.');
    }

    public function reorderList(Request $request, Menu $menu)
    {
        // Drag and drop ordering logic (AJAX)
        // Accepts json array of items with id, parent_id, sort_order
        $items = $request->input('items', []);

        foreach ($items as $itemData) {
            MenuItem::where('id', $itemData['id'])->where('menu_id', $menu->id)->update([
                'parent_id' => $itemData['parent_id'] ?? null,
                'sort_order' => $itemData['sort_order'],
            ]);
        }

        $this->menuService->clearCache();

        return response()->json(['success' => true]);
    }
}
