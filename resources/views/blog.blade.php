@extends('layouts.app')

@section('title', 'Blog - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', \App\Models\Setting::get('blog_meta_description', 'Read the latest articles and insights.'))

@section('content')

    <!--==============================
                    Breadcumb
                    ============================== -->
    <div class="breadcumb-wrapper"
        data-bg-src="{!! \App\Models\Setting::get('blog_hero_image') ? asset(\App\Models\Setting::get('blog_hero_image')) : asset('assets/img/bg/breadcumb-bg1-8.jpg') !!}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{!! \App\Models\Setting::get('blog_breadcrumb_title', 'Blog') !!}</h1>
            </div>
        </div>
    </div>

    <!-- blog-area -->
    <section class="blog__area space">
        <div class="container">
            <div class="blog__inner-wrap">
                <div class="row">
                    <div class="col-70">
                        <div class="blog-post-wrap">
                            <div class="row gy-50 gutter-24">
                                @forelse($posts as $post)
                                    <div class="col-md-12">
                                        <div class="blog-post-item">
                                            <div class="blog-post-thumb">
                                                <a href="{{ route('blog.detail', $post->slug) }}">
                                                    <img src="{{ $post->image ? asset($post->image) : asset('assets/img/blog/blog_post1_1.png') }}"
                                                        alt="{{ $post->title }}">
                                                </a>
                                            </div>
                                            <div class="blog-post-content">
                                                <div class="blog-post-meta">
                                                    <ul class="list-wrap">
                                                        <li>{{ ($post->published_at ?? $post->created_at)->format('F d, Y') }}
                                                        </li>
                                                        <li>
                                                            <a
                                                                href="{{ route('blog', ['category' => $post->category->slug ?? '']) }}">{{ $post->category->name ?? 'Uncategorized' }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <h2 class="title"><a
                                                        href="{{ route('blog.detail', $post->slug) }}">{{ $post->title }}</a>
                                                </h2>
                                                @if($post->excerpt)
                                                <p>{{ Str::limit($post->excerpt, 150) }}</p>@endif
                                                <a href="{{ route('blog.detail', $post->slug) }}" class="link-btn">
                                                    <span class="link-effect">
                                                        <span class="effect-1">READ MORE</span>
                                                        <span class="effect-1">READ MORE</span>
                                                    </span>
                                                    <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center">
                                        <p>No blog posts found.</p>
                                    </div>
                                @endforelse
                            </div>

                            @if($posts->hasPages())
                                <div class="pagination-wrap mt-50">
                                    {{ $posts->appends(request()->query())->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-30">
                        @include('partials.blog-sidebar')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==============================
                    Marquee Area
                    ==============================-->
    <div class="container-fluid p-0 overflow-hidden">
        <div class="slider__marquee clearfix marquee-wrap">
            <div class="marquee_mode marquee__group">
                @for($i = 0; $i < 4; $i++)
                    <h6 class="item m-item"><a href="javascript:void(0)"><i class="fas fa-star-of-life"></i>
                            {{ $siteSettings['marquee_text'] ?? 'We Give Unparalleled Flexibility' }}</a></h6>
                @endfor
            </div>
        </div>
    </div>

@endsection
