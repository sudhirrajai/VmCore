<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q', '');

        if (strlen($query) < 2) {
            return response()->json(['results' => []]);
        }

        $results = [];

        // Search Projects
        $projects = Project::where('title', 'like', "%{$query}%")
            ->take(5)->get();
        foreach ($projects as $item) {
            $results[] = [
                'type' => 'Project',
                'icon' => 'bx bx-briefcase',
                'name' => $item->title,
                'url' => route('admin.projects.edit', $item->id),
            ];
        }

        // Search Blog Posts
        $posts = BlogPost::where('title', 'like', "%{$query}%")
            ->take(5)->get();
        foreach ($posts as $item) {
            $results[] = [
                'type' => 'Blog Post',
                'icon' => 'bx bx-news',
                'name' => $item->title,
                'url' => route('admin.blog.edit', $item->id),
            ];
        }

        // Search Services
        $services = Service::where('title', 'like', "%{$query}%")
            ->take(5)->get();
        foreach ($services as $item) {
            $results[] = [
                'type' => 'Service',
                'icon' => 'bx bx-cog',
                'name' => $item->title,
                'url' => route('admin.services.edit', $item->id),
            ];
        }

        // Search Project Categories
        $projectCats = ProjectCategory::where('title', 'like', "%{$query}%")
            ->take(5)->get();
        foreach ($projectCats as $item) {
            $results[] = [
                'type' => 'Project Category',
                'icon' => 'bx bx-category',
                'name' => $item->title,
                'url' => route('admin.project-categories.edit', $item->id),
            ];
        }

        // Search Blog Categories
        $blogCats = BlogCategory::where('title', 'like', "%{$query}%")
            ->take(5)->get();
        foreach ($blogCats as $item) {
            $results[] = [
                'type' => 'Blog Category',
                'icon' => 'bx bx-folder',
                'name' => $item->title,
                'url' => route('admin.blog-categories.edit', $item->id),
            ];
        }

        // Search Team Members
        $members = TeamMember::where('name', 'like', "%{$query}%")
            ->take(5)->get();
        foreach ($members as $item) {
            $results[] = [
                'type' => 'Team Member',
                'icon' => 'bx bx-user',
                'name' => $item->name,
                'url' => route('admin.team.edit', $item->id),
            ];
        }

        return response()->json(['results' => $results]);
    }
}
