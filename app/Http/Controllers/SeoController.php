<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Page;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    /**
     * Generate dynamic sitemap.xml
     */
    public function sitemap()
    {
        if (Setting::get('sitemap_enabled', '1') !== '1') {
            abort(404);
        }

        $items = [];

        // 1. Static Routes
        $staticRoutes = [
            'home' => 1.0,
            'about' => 0.8,
            'services' => 0.8,
            'portfolio' => 0.8,
            'blog' => 0.8,
            'team' => 0.7,
            'faq' => 0.7,
            'contact' => 0.9,
        ];

        foreach ($staticRoutes as $route => $priority) {
            try {
                $items[] = [
                    'loc' => route($route),
                    'lastmod' => now()->startOfDay()->toAtomString(),
                    'changefreq' => 'weekly',
                    'priority' => $priority,
                ];
            } catch (\Exception $e) {
                // Route might not exist, skip it
            }
        }

        // 2. Dynamic Services
        $services = Service::where('status', true)->get();
        foreach ($services as $service) {
            $items[] = [
                'loc' => route('service.detail', $service->slug),
                'lastmod' => $service->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => 0.7,
            ];
        }

        // 3. Dynamic Projects
        $projects = Project::where('status', true)->get();
        foreach ($projects as $project) {
            $items[] = [
                'loc' => route('portfolio.detail', $project->slug),
                'lastmod' => $project->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => 0.7,
            ];
        }

        // 4. Dynamic Blog Posts
        $posts = BlogPost::published()->get();
        foreach ($posts as $post) {
            $items[] = [
                'loc' => route('blog.detail', $post->slug),
                'lastmod' => ($post->published_at ?? $post->updated_at)->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => 0.6,
            ];
        }

        // 5. Dynamic CMS Pages
        $pages = Page::where('status', \App\Enums\StatusEnum::PUBLISHED)->get();
        foreach ($pages as $page) {
            $items[] = [
                'loc' => route('page', $page->slug),
                'lastmod' => $page->updated_at->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => 0.5,
            ];
        }

        $xml = view('seo.sitemap', compact('items'))->render();

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }

    /**
     * Serve dynamic robots.txt
     */
    public function robots()
    {
        $content = Setting::get('robots_txt');

        if (!$content) {
            $content = "User-agent: *\nAllow: /\n\nSitemap: " . route('sitemap');
        }

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
