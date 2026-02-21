<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

abstract class AdminBaseController extends Controller
{
    protected string $model;
    protected string $viewPrefix;
    protected string $routePrefix;
    protected string $title;

    /**
     * Handle image upload
     */
    protected function uploadImage(Request $request, string $field = 'image', string $folder = 'uploads'): ?string
    {
        if ($request->hasFile($field)) {
            $file = $request->file($field);
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                . '.' . $file->getClientOriginalExtension();
            $file->move(public_path("uploads/{$folder}"), $filename);
            return "uploads/{$folder}/{$filename}";
        }
        return null;
    }

    /**
     * Delete old image
     */
    protected function deleteImage(?string $path): void
    {
        if ($path && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }

    /**
     * Toggle status via AJAX
     */
    public function toggleStatus($id)
    {
        $item = $this->model::findOrFail($id);
        $item->toggleStatus();

        return response()->json([
            'success' => true,
            'status' => $item->status,
            'message' => $this->title . ' status updated successfully.',
        ]);
    }

    /**
     * Bulk delete
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return back()->with('error', 'No items selected.');
        }

        $this->model::whereIn('id', $ids)->delete();

        return back()->with('success', count($ids) . ' items deleted successfully.');
    }

    /**
     * Bulk status change
     */
    public function bulkStatusChange(Request $request)
    {
        $ids = $request->input('ids', []);
        $status = $request->input('status', true);

        if (empty($ids)) {
            return back()->with('error', 'No items selected.');
        }

        $this->model::whereIn('id', $ids)->update(['status' => $status]);

        return back()->with('success', count($ids) . ' items updated successfully.');
    }
}
