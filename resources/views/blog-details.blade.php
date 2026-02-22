@extends('layouts.app')

@section('title', ($post->meta_title ?? $post->title) . ' - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', $post->meta_description ?? $post->excerpt ?? '')
@if($post->image)
@section('og_image', asset($post->image))
@endif

@section('content')

    <!--==============================
                Breadcumb
                ============================== -->
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('assets/img/bg/breadcumb-bg1-8.jpg') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{{ $post->title }}</h1>
            </div>
        </div>
    </div>

    <!-- blog-details -->
    <section class="blog-details space">
        <div class="container">
            <div class="row">
                <div class="col-70">
                    <div class="blog-details-wrap">
                        @if($post->image)
                            <div class="blog-details-thumb mb-30">
                                <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="w-100">
                            </div>
                        @endif
                        <div class="blog-post-meta mb-20">
                            <ul class="list-wrap">
                                <li>{{ ($post->published_at ?? $post->created_at)->format('F d, Y') }}</li>
                                <li><a
                                        href="{{ route('blog', ['category' => $post->category->slug ?? '']) }}">{{ $post->category->name ?? 'Uncategorized' }}</a>
                                </li>
                                @if($post->author)
                                <li>By {{ $post->author->name }}</li>@endif
                            </ul>
                        </div>
                        <h2 class="blog-details-title">{{ $post->title }}</h2>
                        @if($post->excerpt)
                            <p class="lead mt-15 mb-30">{{ $post->excerpt }}</p>
                        @endif
                        <div class="blog-details-content mt-30">
                            {!! $post->body !!}
                        </div>
                        @if($post->tags->count())
                            <div class="blog-details-tags mt-30">
                                <strong>Tags:</strong>
                                @foreach($post->tags as $tag)
                                    <a href="javascript:void(0)" class="badge bg-secondary text-white ms-1">{{ $tag->title }}</a>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Related Posts --}}
                    @if($relatedPosts->count())
                        <div class="related-posts mt-50">
                            <h3 class="mb-30">Related Posts</h3>
                            <div class="row gy-30">
                                @foreach($relatedPosts as $related)
                                    <div class="col-md-4">
                                        <a href="{{ route('blog.detail', $related->slug) }}" class="blog-card style2">
                                            <div class="blog-img">
                                                <img src="{{ $related->image ? asset($related->image) : asset('assets/img/blog/blog_2_1.png') }}"
                                                    alt="{{ $related->title }}">
                                            </div>
                                            <div class="blog-content">
                                                <div class="post-meta-item blog-meta">
                                                    <span>{{ ($related->published_at ?? $related->created_at)->format('F d, Y') }}</span>
                                                </div>
                                                <h4 class="blog-title">{{ $related->title }}</h4>
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