@extends('layouts.app')

@section('title', ($post->meta_title ?? $post->title) . ' - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', $post->meta_description ?? $post->excerpt ?? '')
@section('meta_keywords', $post->tags->count() ? $post->tags->pluck('title')->implode(', ') : '')
@section('og_type', 'article')
@section('canonical', route('blog.detail', $post->slug))
@if($post->meta_robots)
    @section('robots', $post->meta_robots)
@endif
@if($post->image)
    @section('og_image', asset($post->image))
@endif

@push('structured_data')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Article",
    "headline": "{{ addslashes($post->meta_title ?? $post->title) }}",
    "description": "{{ addslashes($post->meta_description ?? $post->excerpt ?? '') }}",
    "image": "{{ $post->image ? asset($post->image) : asset($siteSettings['logo'] ?? '') }}",
    "datePublished": "{{ ($post->published_at ?? $post->created_at)->toIso8601String() }}",
    "dateModified": "{{ $post->updated_at->toIso8601String() }}",
    "author": {
        "@@type": "Person",
        "name": "{{ addslashes($post->author->name ?? ($siteSettings['site_name'] ?? 'VMCore')) }}"
    },
    "publisher": {
        "@@type": "Organization",
        "name": "{{ addslashes($siteSettings['site_name'] ?? 'VMCore') }}",
        "logo": {
            "@@type": "ImageObject",
            "url": "{{ asset($siteSettings['logo'] ?? '') }}"
        }
    },
    "mainEntityOfPage": {
        "@@type": "WebPage",
        "@@id": "{{ route('blog.detail', $post->slug) }}"
    }
}
</script>
{!! $post->faq_schema_script !!}
@endpush

@push('styles')
<style>
    /* ── Article Layout ── */
    .article-layout {
        display: grid;
        grid-template-columns: 1fr;
        gap: 3rem;
        max-width: 1440px;
        margin: 0 auto;
        padding: 0 2rem 6rem;
    }

    @media (min-width: 1024px) {
        .article-layout {
            grid-template-columns: 1fr 320px;
            align-items: start;
        }
    }

    /* ── Article Hero Image ── */
    .article-hero-img {
        width: 100%;
        max-height: 520px;
        object-fit: cover;
        border-radius: 1rem;
        margin-bottom: 2.5rem;
    }

    /* ── Article Meta ── */
    .article-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 1rem;
        font-size: 0.8rem;
        color: #94a3b8;
        margin-bottom: 1.25rem;
    }

    .article-meta a {
        color: var(--theme-color, #4A76B2);
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        font-size: 0.72rem;
        text-decoration: none;
    }

    .article-meta span {
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    /* ── Article Title ── */
    .article-main-title {
        font-size: clamp(1.75rem, 4vw, 3rem);
        font-weight: 800;
        line-height: 1.2;
        color: #0f172a;
        margin-bottom: 1.25rem;
    }

    /* ── Article Excerpt ── */
    .article-excerpt {
        font-size: 1.05rem;
        color: #64748b;
        line-height: 1.75;
        margin-bottom: 2.5rem;
        padding-left: 1.25rem;
        border-left: 3px solid var(--theme-color, #4A76B2);
    }

    /* ── Article Body (CKEditor HTML) ── */
    .article-body {
        font-size: 1rem;
        color: #334155;
        line-height: 1.85;
    }

    .article-body h1,
    .article-body h2,
    .article-body h3,
    .article-body h4 {
        font-weight: 700;
        color: #0f172a;
        margin-top: 2rem;
        margin-bottom: 0.75rem;
        line-height: 1.3;
    }

    .article-body h2 { font-size: 1.6rem; }
    .article-body h3 { font-size: 1.3rem; }
    .article-body h4 { font-size: 1.1rem; }

    .article-body p {
        margin-bottom: 1.25rem;
    }

    .article-body ul,
    .article-body ol {
        padding-left: 1.5rem;
        margin-bottom: 1.25rem;
    }

    .article-body ul { list-style: disc; }
    .article-body ol { list-style: decimal; }

    .article-body li { margin-bottom: 0.4rem; }

    .article-body img {
        max-width: 100%;
        height: auto;
        border-radius: 0.75rem;
        margin: 1.5rem 0;
    }

    .article-body a {
        color: var(--theme-color, #4A76B2);
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    .article-body blockquote {
        border-left: 4px solid var(--theme-color, #4A76B2);
        padding: 1rem 1.5rem;
        margin: 1.5rem 0;
        background: #f8fafc;
        border-radius: 0 0.5rem 0.5rem 0;
        color: #475569;
        font-style: italic;
    }

    .article-body pre,
    .article-body code {
        background: #f1f5f9;
        border-radius: 0.375rem;
        font-family: 'Fira Mono', monospace;
        font-size: 0.875rem;
    }

    .article-body pre {
        padding: 1.25rem;
        overflow-x: auto;
        margin-bottom: 1.25rem;
    }

    .article-body code {
        padding: 0.15em 0.4em;
    }

    .article-body table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .article-body th,
    .article-body td {
        padding: 0.6rem 0.9rem;
        border: 1px solid #e2e8f0;
        text-align: left;
    }

    .article-body th {
        background: #f8fafc;
        font-weight: 700;
        color: #1e293b;
    }

    /* ── Tags ── */
    .article-tags {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 0.5rem;
        margin-top: 2.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f1f5f9;
    }

    .article-tags .tag-label {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #94a3b8;
        margin-right: 0.25rem;
    }

    .article-tag {
        font-size: 0.75rem;
        padding: 0.3rem 0.8rem;
        background: #f1f5f9;
        color: #475569;
        border-radius: 9999px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .article-tag:hover {
        background: #0f172a;
        color: #fff;
    }

    /* ── Related Posts ── */
    .related-posts-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    @media (min-width: 640px) {
        .related-posts-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .related-post-card {
        border-radius: 0.75rem;
        overflow: hidden;
        background: #fff;
        border: 1px solid #f1f5f9;
        text-decoration: none;
        display: block;
        transition: box-shadow 0.3s ease, transform 0.3s ease, border-color 0.3s ease;
        position: relative;
    }

    .related-post-card:hover {
        box-shadow: 0 16px 40px rgba(0,0,0,0.09);
        transform: translateY(-4px);
        border-color: #e2e8f0;
    }

    /* Image overlay on related cards */
    .related-post-card .rp-img-wrap {
        position: relative;
        overflow: hidden;
    }

    .related-post-card .rp-img-wrap::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(15,23,42,0);
        transition: background 0.35s ease;
    }

    .related-post-card:hover .rp-img-wrap::after {
        background: rgba(15,23,42,0.15);
    }

    .related-post-card img {
        width: 100%;
        aspect-ratio: 16/9;
        object-fit: cover;
        transition: transform 0.4s ease;
        display: block;
    }

    .related-post-card:hover img {
        transform: scale(1.07);
    }

    .related-post-card .rp-body {
        padding: 1rem;
    }

    .related-post-card .rp-date {
        font-size: 0.72rem;
        color: #94a3b8;
        margin-bottom: 0.4rem;
    }

    .related-post-card h4 {
        font-size: 0.9rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.4;
        transition: color 0.2s ease;
    }

    .related-post-card:hover h4 {
        color: var(--theme-color, #4A76B2);
    }

    /* ── Sidebar (same style as blog.blade.php) ── */
    .blog-sidebar { position: sticky; top: 100px; }

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

    .sidebar-search-form { display: flex; gap: 0.5rem; }

    .sidebar-search-form input {
        flex: 1;
        padding: 0.6rem 0.9rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        font-size: 0.85rem;
        outline: none;
        transition: border-color 0.2s ease;
    }

    .sidebar-search-form input:focus { border-color: var(--theme-color, #4A76B2); }

    .sidebar-search-form button {
        padding: 0.6rem 0.9rem;
        background: #0f172a;
        color: #fff;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        transition: background 0.2s ease;
    }

    .sidebar-search-form button:hover { background: var(--theme-color, #4A76B2); }

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

    .sidebar-cat-list a:hover { color: var(--theme-color, #4A76B2); background: #f8fafc; padding-left: 1rem; }

    .sidebar-cat-list .count {
        font-size: 0.75rem;
        color: #94a3b8;
        background: #f1f5f9;
        padding: 0.15rem 0.5rem;
        border-radius: 9999px;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .sidebar-cat-list a:hover .count { background: var(--theme-color, #4A76B2); color: #fff; }

    .sidebar-recent-post {
        display: flex;
        gap: 0.875rem;
        padding: 0.5rem;
        border-bottom: 1px solid #f1f5f9;
        margin: 0 -0.5rem 0.875rem;
        border-radius: 0.5rem;
        transition: background 0.2s ease;
    }

    .sidebar-recent-post:last-child { border-bottom: none; padding-bottom: 0.5rem; margin-bottom: 0; }

    .sidebar-recent-post:hover { background: #f8fafc; }

    .sidebar-recent-post img {
        width: 64px;
        height: 64px;
        object-fit: cover;
        border-radius: 0.5rem;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .sidebar-recent-post:hover img { transform: scale(1.06); }

    .sidebar-recent-post h5 {
        font-size: 0.825rem;
        font-weight: 600;
        color: #1e293b;
        line-height: 1.4;
        margin-bottom: 0.25rem;
        transition: color 0.2s ease;
    }

    .sidebar-recent-post a:hover h5 { color: var(--theme-color, #4A76B2); }

    .sidebar-recent-post .date { font-size: 0.72rem; color: #94a3b8; }

    .sidebar-tag-list { display: flex; flex-wrap: wrap; gap: 0.5rem; }

    .sidebar-tag-list a {
        font-size: 0.75rem;
        padding: 0.3rem 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 9999px;
        color: #475569;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .sidebar-tag-list a:hover { background: #0f172a; border-color: #0f172a; color: #fff; }
</style>
@endpush

@section('content')

    {{-- Hero Heading (matches portfolio-details style) --}}
    <section style="padding: 3.5rem 0 2rem; overflow: hidden;">
        <div class="container-custom">

            {{-- Centered title block --}}
            <div style="display:flex; flex-direction:column; align-items:center; text-align:center; margin-bottom: 2.5rem;" class="animate-fade-in-up">

                {{-- Category badge --}}
                @if($post->category)
                    <a href="{{ route('blog', ['category' => $post->category->slug]) }}"
                       style="color: var(--theme-color, #4A76B2); font-size: 0.75rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; text-decoration: none; margin-bottom: 1rem; display: inline-block; transition: opacity 0.2s ease;"
                       onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                        {{ $post->category->name }}
                    </a>
                @endif

                {{-- Main title --}}
                <h1 style="font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 800; line-height: 1.15; color: #0f172a; margin-bottom: 1.25rem; max-width: 900px;" itemprop="headline">
                    {{ $post->title }}
                </h1>

                {{-- Meta row --}}
                <div style="display:flex; flex-wrap:wrap; align-items:center; justify-content:center; gap: 1.25rem; font-size: 0.85rem; color: #94a3b8;">
                    <span style="display:flex; align-items:center; gap: 0.4rem;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        <time datetime="{{ ($post->published_at ?? $post->created_at)->toIso8601String() }}">
                            {{ ($post->published_at ?? $post->created_at)->format('F d, Y') }}
                        </time>
                    </span>
                    @if($post->author)
                        <span style="color: #cbd5e1;">·</span>
                        <span style="display:flex; align-items:center; gap: 0.4rem;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                            {{ $post->author->name }}
                        </span>
                    @endif
                </div>
            </div>

            {{-- Featured image in framed showcase --}}
            @if($post->image)
                <div style="position:relative; max-width: 900px; margin: 0 auto;" class="animate-fade-in-up">
                    <div style="position:relative; z-index:1; border-radius:1rem; overflow:hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.18); border: 1px solid #f1f5f9; background:#fff; padding: 0.75rem;">
                        <img src="{{ asset($post->image) }}"
                             alt="{{ $post->title }}"
                             style="width:100%; display:block; border-radius: 0.5rem;"
                             loading="eager"
                             itemprop="image">
                    </div>
                    {{-- Decorative blur circles --}}
                    <div style="position:absolute; width:220px; height:220px; border-radius:50%; filter:blur(70px); z-index:0; pointer-events:none; background: color-mix(in srgb, var(--theme-color, #4A76B2) 8%, transparent); bottom:-30px; right:-30px;"></div>
                    <div style="position:absolute; width:220px; height:220px; border-radius:50%; filter:blur(70px); z-index:0; pointer-events:none; background: color-mix(in srgb, var(--theme-color, #4A76B2) 5%, transparent); top:-30px; left:-30px;"></div>
                </div>
            @endif

        </div>
    </section>

    {{-- Main content --}}
    <div class="article-layout">

        {{-- Article --}}
        <article itemscope itemtype="https://schema.org/BlogPosting">


            {{-- Excerpt --}}
            @if($post->excerpt)
                <p class="article-excerpt" itemprop="description">{{ $post->excerpt }}</p>
            @endif

            {{-- Body — rendered as full HTML from CKEditor --}}
            <div class="article-body" itemprop="articleBody">
                {!! $post->body !!}
            </div>

            {{-- Tags --}}
            @if($post->tags->count())
                <div class="article-tags">
                    <span class="tag-label">{!! setting('blog_tags_label', 'Tags') !!}</span>
                    @foreach($post->tags as $tag)
                        <a href="{{ route('blog', ['search' => $tag->title]) }}" class="article-tag">
                            {{ $tag->title }}
                        </a>
                    @endforeach
                </div>
            @endif

            {{-- Related Posts --}}
            @if($relatedPosts->count())
                <section class="mt-16">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">
                        {!! setting('blog_related_title', 'Related Posts') !!}
                    </h2>
                    <div class="related-posts-grid">
                        @foreach($relatedPosts as $related)
                            <a href="{{ route('blog.detail', $related->slug) }}" class="related-post-card">
                                <div class="rp-img-wrap">
                                    <img src="{{ $related->image ? asset($related->image) : asset('assets/img/blog/blog_2_1.png') }}"
                                         alt="{{ $related->title }}"
                                         loading="lazy">
                                </div>
                                <div class="rp-body">
                                    <p class="rp-date">{{ ($related->published_at ?? $related->created_at)->format('M d, Y') }}</p>
                                    <h4>{{ Str::limit($related->title, 60) }}</h4>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

        </article>

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

            {{-- Back to blog --}}
            <div class="sidebar-widget text-center">
                <a href="{{ route('blog') }}"
                   class="inline-flex items-center gap-2 text-sm font-semibold text-slate-700 hover:text-slate-900 transition-colors">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
                    Back to Blog
                </a>
            </div>
        </aside>

    </div>

@endsection