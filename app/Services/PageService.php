<?php

namespace App\Services;

use App\Models\Page;
use App\Enums\StatusEnum;
use Illuminate\Support\Facades\Cache;

class PageService
{
    /**
     * Retrieve a published page by its slug (Cached).
     */
    public function getPageBySlug(string $slug)
    {
        return Cache::rememberForever('page_' . $slug, function () use ($slug) {
            return Page::where('slug', $slug)
                ->where('status', StatusEnum::PUBLISHED)
                ->first();
        });
    }

    /**
     * Clear cache for a specific page slug.
     */
    public function clearCache(string $slug)
    {
        Cache::forget('page_' . $slug);
    }
}
