@extends('layouts.app')

@section('title', ($post->meta_title ?? $post->title) . ' - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', $post->meta_description ?? $post->excerpt ?? '')
@section('meta_keywords', $post->tags->count() ? $post->tags->pluck('title')->implode(', ') : '')
@section('og_type', 'article')
@section('canonical', route('blog.detail', $post->slug))
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
@endpush


@section('content')

    <!--==============================
                                        Breadcumb
                                        ============================== -->
    <div class="breadcumb-wrapper"
        data-bg-src="{{ $post->banner_image ? asset($post->banner_image) : asset($post->image) }}">
        <div class="container">
                <h1 class="text-5xl lg:text-7xl font-bold leading-tight breadcumb-title">{{ $post->title }}</h1>
            </div>
        </div>
    </div>

    <!-- blog-details -->
    <section class="blog-details space">
        <div class="container">
            <div class="row">
                <div class="col-70">
                    <article class="blog-details-wrap" itemscope itemtype="https://schema.org/BlogPosting">
                        @if($post->image)
                            <div class="blog-details-thumb mb-30">
                                <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="w-100" loading="eager" itemprop="image">
                            </div>
                        @endif
                        <div class="blog-post-meta mb-20 text-sm text-slate-500">
                            <ul class="list-wrap">
                                <li><time datetime="{{ ($post->published_at ?? $post->created_at)->toIso8601String() }}" itemprop="datePublished">{{ ($post->published_at ?? $post->created_at)->format('F d, Y') }}</time></li>
                                <li><a
                                        href="{{ route('blog', ['category' => $post->category->slug ?? '']) }}">{{ $post->category->name ?? 'Uncategorized' }}</a>
                                </li>
                                @if($post->author)
                                <li>By {{ $post->author->name }}</li>@endif
                            </ul>
                        </div>
                        <h2 class="text-2xl lg:text-4xl font-semibold leading-tight blog-details-title mb-4">{{ $post->title }}</h2>
                        @if($post->excerpt)
                            <p class="text-base leading-relaxed text-slate-500 mt-15 mb-30">{{ $post->excerpt }}</p>
                        @endif
                        <div class="blog-details-content mt-30">
                            {!! $post->body !!}
                        </div>
                        @if($post->tags->count())
                            <div class="blog-details-tags mt-30">
                                <strong>{!! setting('blog_tags_label', 'Tags:') !!}</strong>
                                @foreach($post->tags as $tag)
                                    <a href="javascript:void(0)" class="badge bg-secondary text-white ms-1">{{ $tag->title }}</a>
                                @endforeach
                            </div>
                        @endif
                    </article>

                    {{-- Related Posts --}}
                    @if($relatedPosts->count())
                        <div class="related-posts mt-50">
                            <h3 class="text-xl lg:text-2xl font-semibold mb-30 text-slate-900">{!! setting('blog_related_title', 'Related Posts') !!}</h3>
                            <div class="row gy-30">
                                @foreach($relatedPosts as $related)
                                    <div class="col-md-4">
                                        <a href="{{ route('blog.detail', $related->slug) }}" class="blog-card style2">
                                            <div class="blog-img">
                                                <img src="{{ $related->image ? asset($related->image) : asset('assets/img/blog/blog_2_1.png') }}"
                                                    alt="{{ $related->title }}">
                                            </div>
                                            <div class="blog-content">
                                                <div class="post-meta-item blog-meta text-sm text-slate-500 mb-2">
                                                    <span>{{ ($related->published_at ?? $related->created_at)->format('F d, Y') }}</span>
                                                </div>
                                                <h4 class="text-lg font-semibold leading-tight blog-title text-slate-900">{{ $related->title }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-30">
                    @include('partials.blog-sidebar')
                </div>
            </div>
        </div>
    </section>

@endsection