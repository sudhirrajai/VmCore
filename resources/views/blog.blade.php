@extends('layouts.app')

@section('title', setting('blog_meta_title', 'Blog - ' . ($siteSettings['site_name'] ?? 'VMCore')))
@section('meta_description', setting('blog_meta_description', 'Read the latest articles and insights.'))
@section('meta_keywords', setting('blog_meta_keywords', 'blog, articles, insights, news, digital agency blog'))
@section('canonical', route('blog'))

@push('structured_data')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "{{ url('/') }}"
        },
        {
            "@@type": "ListItem",
            "position": 2,
            "name": "Blog",
            "item": "{{ route('blog') }}"
        }
    ]
}
</script>
{!! setting('blog_page_faq_schema') !!}
@endpush

@push('styles')
<style>
    /* ── Blog Grid ── */
    .blog-grid-container {
        max-width: 1440px;
        margin-left: auto;
        margin-right: auto;
        padding-left: 2rem;
        padding-right: 2rem;
        padding-bottom: 6rem;
    }

    /* Main + Sidebar layout */
    .blog-layout {
        display: grid;
        grid-template-columns: 1fr;
        gap: 3rem;
    }

    @media (min-width: 1024px) {
        .blog-layout {
            grid-template-columns: 1fr 320px;
            align-items: start;
        }
    }

    /* ── Blog Card (horizontal compact) ── */
    .blog-card-modern {
        display: flex;
        flex-direction: row;
        align-items: stretch;
        background: #fff;
        border-radius: 0.875rem;
        overflow: hidden;
        border: 1px solid #f1f5f9;
        transition: box-shadow 0.3s ease, transform 0.3s ease, border-color 0.3s ease;
        position: relative;
    }

    .blog-card-modern:hover {
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        transform: translateY(-4px);
        border-color: #e2e8f0;
    }

    /* Thumbnail — fixed small width */
    .blog-card-modern .card-img-wrap {
        flex-shrink: 0;
        width: 200px;
        overflow: hidden;
        position: relative;
    }

    /* Image overlay on hover */
    .blog-card-modern .card-img-wrap::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, 0);
        transition: background 0.35s ease;
    }

    .blog-card-modern:hover .card-img-wrap::after {
        background: rgba(15, 23, 42, 0.18);
    }

    @media (max-width: 600px) {
        .blog-card-modern {
            flex-direction: column;
        }
        .blog-card-modern .card-img-wrap {
            width: 100%;
            height: 180px;
        }
    }

    .blog-card-modern .card-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .blog-card-modern:hover .card-img-wrap img {
        transform: scale(1.08);
    }

    .blog-card-modern .card-body {
        padding: 1.25rem 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 0.3rem;
        flex: 1;
        min-width: 0;
        border-left: 3px solid transparent;
        transition: border-color 0.3s ease;
    }

    .blog-card-modern:hover .card-body {
        border-left-color: #0f172a;
    }

    .blog-cat-badge {
        display: inline-block;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--theme-color, #4A76B2);
        transition: color 0.2s ease;
    }

    .blog-cat-badge:hover {
        color: #0f172a;
    }

    .blog-card-title {
        font-size: 1.05rem;
        font-weight: 700;
        line-height: 1.4;
        color: #0f172a;
        margin: 0;
        transition: color 0.2s ease;
    }

    .blog-card-title a:hover {
        color: var(--theme-color, #4A76B2);
    }

    .blog-card-excerpt {
        font-size: 0.84rem;
        color: #64748b;
        line-height: 1.6;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .blog-card-meta {
        display: flex;
        align-items: center;
        gap: 0.875rem;
        font-size: 0.74rem;
        color: #94a3b8;
        margin: 0;
    }

    .blog-card-meta span {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .blog-read-more {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #0f172a;
        text-decoration: none;
        transition: gap 0.25s ease, color 0.25s ease;
    }

    .blog-read-more svg {
        transition: transform 0.25s ease;
    }

    .blog-read-more:hover {
        gap: 0.7rem;
        color: var(--theme-color, #4A76B2);
    }

    .blog-read-more:hover svg {
        transform: translateX(3px);
    }

    /* ── Sidebar ── */
    .blog-sidebar {
        position: sticky;
        top: 100px;
    }

    .sidebar-widget {
        background: #fff;
        border: 1px solid #f1f5f9;
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .sidebar-widget:hover {
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
        border-color: #e2e8f0;
    }

    .sidebar-widget-title {
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #334155;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f1f5f9;
    }

    .sidebar-search-form {
        display: flex;
        gap: 0.5rem;
    }

    .sidebar-search-form input {
        flex: 1;
        padding: 0.6rem 0.9rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        font-size: 0.85rem;
        outline: none;
        transition: border-color 0.2s ease;
    }

    .sidebar-search-form input:focus {
        border-color: var(--theme-color, #4A76B2);
    }

    .sidebar-search-form button {
        padding: 0.6rem 0.9rem;
        background: #0f172a;
        color: #fff;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: background 0.2s ease;
        display: flex;
        align-items: center;
    }

    .sidebar-search-form button:hover {
        background: var(--theme-color, #4A76B2);
    }

    .sidebar-cat-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .sidebar-cat-list a {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.875rem;
        color: #475569;
        text-decoration: none;
        padding: 0.5rem 0.6rem;
        border-radius: 0.4rem;
        margin: 0 -0.6rem;
        border-bottom: 1px solid #f8fafc;
        transition: background 0.2s ease, color 0.2s ease, padding-left 0.2s ease;
    }

    .sidebar-cat-list a:hover {
        color: var(--theme-color, #4A76B2);
        background: #f8fafc;
        padding-left: 1rem;
    }

    .sidebar-cat-list .count {
        font-size: 0.75rem;
        color: #94a3b8;
        background: #f1f5f9;
        padding: 0.15rem 0.5rem;
        border-radius: 9999px;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .sidebar-cat-list a:hover .count {
        background: var(--theme-color, #4A76B2);
        color: #fff;
    }

    .sidebar-recent-post {
        display: flex;
        gap: 0.875rem;
        padding-bottom: 0.875rem;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 0.875rem;
        border-radius: 0.5rem;
        transition: background 0.2s ease;
        padding: 0.5rem;
        margin: 0 -0.5rem 0.875rem;
    }

    .sidebar-recent-post:last-child {
        border-bottom: none;
        padding-bottom: 0.5rem;
        margin-bottom: 0;
    }

    .sidebar-recent-post:hover {
        background: #f8fafc;
    }

    .sidebar-recent-post img {
        width: 64px;
        height: 64px;
        object-fit: cover;
        border-radius: 0.5rem;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .sidebar-recent-post:hover img {
        transform: scale(1.06);
    }

    .sidebar-recent-post h5 {
        font-size: 0.825rem;
        font-weight: 600;
        color: #1e293b;
        line-height: 1.4;
        margin-bottom: 0.25rem;
        transition: color 0.2s ease;
    }

    .sidebar-recent-post a:hover h5 {
        color: var(--theme-color, #4A76B2);
    }

    .sidebar-recent-post .date {
        font-size: 0.72rem;
        color: #94a3b8;
    }

    .sidebar-tag-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .sidebar-tag-list a {
        font-size: 0.75rem;
        padding: 0.3rem 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 9999px;
        color: #475569;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .sidebar-tag-list a:hover {
        background: #0f172a;
        border-color: #0f172a;
        color: #fff;
    }

    /* ── Category filter pills ── */
    .blog-filter-pill {
        display: inline-block;
        padding: 0.4rem 1.1rem;
        border-radius: 9999px;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .blog-filter-pill.active {
        background: #0f172a;
        color: #fff;
    }

    .blog-filter-pill:not(.active) {
        background: #fff;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .blog-filter-pill:not(.active):hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #334155;
    }
</style>
@endpush

@section('content')

    {{-- Hero Section --}}
    <section class="pt-20 pb-12 px-8 text-center max-w-4xl mx-auto animate-fade-in-up">
        <h1 class="text-5xl lg:text-7xl font-bold leading-tight text-slate-900 mb-6">
            {!! \App\Models\Setting::get('blog_hero_title', 'Latest <em style="font-style:italic;font-weight:300">Insights</em>') !!}
        </h1>
        <p class="text-base leading-relaxed text-slate-500">
            {!! \App\Models\Setting::get('blog_hero_subtitle', 'Ideas, perspectives, and stories from our team.') !!}
        </p>
    </section>

    {{-- Category Filter (portfolio-style pills) --}}
    <section class="px-8 animate-fade-in-up delay-200" style="padding-bottom: 3rem;">
        <div class="flex flex-wrap justify-center gap-3">
            <a href="{{ route('blog') }}"
               class="px-6 py-2 rounded-md text-sm font-medium transition-all duration-200 {{ !request('category') && !request('search') ? 'text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200' }}"
               style="{{ !request('category') && !request('search') ? 'background-color: #111827;' : '' }}">
                All
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('blog', ['category' => $cat->slug]) }}"
                   class="px-6 py-2 rounded-md text-sm font-medium transition-all duration-200 {{ request('category') == $cat->slug ? 'text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200' }}"
                   style="{{ request('category') == $cat->slug ? 'background-color: #111827;' : '' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </section>

    {{-- Main Content --}}
    <div class="blog-grid-container">
        <div class="blog-layout">

            {{-- Posts --}}
            <div>
                @if(request('search'))
                    <p class="text-sm text-slate-500 mb-6">
                        Showing results for: <strong class="text-slate-800">"{{ request('search') }}"</strong>
                        &mdash; <a href="{{ route('blog') }}" class="underline text-slate-600">Clear</a>
                    </p>
                @endif

                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    @forelse($posts as $post)
                        <article class="blog-card-modern" itemscope itemtype="https://schema.org/BlogPosting">

                            {{-- Thumbnail --}}
                            @if($post->image)
                                <a href="{{ route('blog.detail', $post->slug) }}" class="card-img-wrap" tabindex="-1">
                                    <img src="{{ asset($post->image) }}"
                                         alt="{{ $post->title }}"
                                         loading="lazy"
                                         itemprop="image">
                                </a>
                            @else
                                <div class="card-img-wrap"
                                     style="background:#f1f5f9; display:flex; align-items:center; justify-content:center; width:200px; flex-shrink:0;">
                                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                                </div>
                            @endif

                            {{-- Body --}}
                            <div class="card-body">
                                <div class="blog-card-meta">
                                    @if($post->category)
                                        <a href="{{ route('blog', ['category' => $post->category->slug]) }}"
                                           class="blog-cat-badge">
                                            {{ $post->category->name }}
                                        </a>
                                        <span style="color:#e2e8f0;">·</span>
                                    @endif
                                    <span>
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                        <time datetime="{{ ($post->published_at ?? $post->created_at)->toIso8601String() }}" itemprop="datePublished">
                                            {{ ($post->published_at ?? $post->created_at)->format('M d, Y') }}
                                        </time>
                                    </span>
                                    @if($post->author)
                                        <span>
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                                            {{ $post->author->name }}
                                        </span>
                                    @endif
                                </div>

                                <h2 class="blog-card-title" itemprop="headline">
                                    <a href="{{ route('blog.detail', $post->slug) }}">{{ $post->title }}</a>
                                </h2>

                                @if($post->excerpt)
                                    <p class="blog-card-excerpt" itemprop="description">{{ $post->excerpt }}</p>
                                @endif

                                <div style="margin-top: 0.65rem;">
                                    <a href="{{ route('blog.detail', $post->slug) }}" class="blog-read-more">
                                        {!! setting('blog_read_more_text', 'Read Article') !!}
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="text-center py-20">
                            <p class="text-slate-400 text-lg mb-4">No blog posts found.</p>
                            <a href="{{ route('blog') }}" class="blog-read-more">View all posts
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </a>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if($posts->hasPages())
                    <div class="mt-12">
                        {{ $posts->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="blog-sidebar">
                {{-- Search --}}
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Search</h3>
                    <form action="{{ route('blog') }}" method="GET" class="sidebar-search-form">
                        <input type="text" name="search" placeholder="Search articles…" value="{{ request('search') }}">
                        <button type="submit" aria-label="Search">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="9" cy="9" r="7"/><path d="M15 15l3 3"/></svg>
                        </button>
                    </form>
                </div>

                {{-- Categories --}}
                @if(isset($categories) && $categories->count())
                    <div class="sidebar-widget">
                        <h3 class="sidebar-widget-title">{!! setting('sidebar_categories_title', 'Categories') !!}</h3>
                        <ul class="sidebar-cat-list">
                            @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('blog', ['category' => $cat->slug]) }}">
                                        {{ $cat->name }}
                                        <span class="count">{{ $cat->posts_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Recent Posts --}}
                @if(isset($recentPosts) && $recentPosts->count())
                    <div class="sidebar-widget">
                        <h3 class="sidebar-widget-title">{!! setting('sidebar_recent_posts_title', 'Recent Posts') !!}</h3>
                        @foreach($recentPosts as $recent)
                            <div class="sidebar-recent-post">
                                <a href="{{ route('blog.detail', $recent->slug) }}" class="flex-shrink-0">
                                    <img src="{{ $recent->image ? asset($recent->image) : asset('assets/img/blog/sb_post01.jpg') }}"
                                         alt="{{ $recent->title }}">
                                </a>
                                <div>
                                    <a href="{{ route('blog.detail', $recent->slug) }}">
                                        <h5>{{ Str::limit($recent->title, 50) }}</h5>
                                    </a>
                                    <span class="date">{{ ($recent->published_at ?? $recent->created_at)->format('M d, Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Tags --}}
                @if(isset($tags) && $tags->count())
                    <div class="sidebar-widget">
                        <h3 class="sidebar-widget-title">{!! setting('sidebar_tags_title', 'Tags') !!}</h3>
                        <div class="sidebar-tag-list">
                            @foreach($tags as $tag)
                                <a href="{{ route('blog', ['search' => $tag->title]) }}">{{ $tag->title }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>

        </div>
    </div>

@endsection