@extends('layouts.app')

@section('title', ($project->meta_title ?? $project->title) . ' - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', $project->meta_description ?? $project->short_description ?? '')

@section('content')

    <!--==============================
                        Breadcumb
                        ============================== -->
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('assets/img/bg/breadcumb-bg1-5.jpg') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{{ $project->title }}</h1>
            </div>
        </div>
    </div>

    <!--==============================
                        Project Details
                        ==============================-->
    <div class="project-details space">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if($project->image)
                        <div class="project-details-thumb mb-40">
                            <img src="{{ asset($project->image) }}" alt="{{ $project->title }}" class="w-100">
                        </div>
                    @endif

                    <h2>{{ $project->title }}</h2>
                    @if($project->short_description)
                        <p class="mt-15 mb-30">{{ $project->short_description }}</p>
                    @endif
                    @if($project->description)
                        <div class="project-details-content mt-30">
                            {!! $project->description !!}
                        </div>
                    @endif

                    {{-- Gallery --}}
                    @if($project->images->count())
                        <div class="project-gallery mt-40">
                            <h4 class="mb-20">{{ setting('portfolio_gallery_title', 'Project Gallery') }}</h4>
                            <div class="row gy-20">
                                @foreach($project->images as $img)
                                    <div class="col-md-4 col-6">
                                        <a href="{{ asset($img->image_path) }}" class="popup-image">
                                            <img src="{{ asset($img->image_path) }}" alt="Gallery" class="w-100">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <aside class="project-sidebar">
                        <div class="widget project-info-box">
                            <h4 class="widget_title">{{ setting('portfolio_info_title', 'Project Info') }}</h4>
                            <ul class="project-info-list">
                                @if($project->client)
                                    <li><strong>Client:</strong> {{ $project->client }}</li>
                                @endif
                                @if($project->category)
                                    <li><strong>Category:</strong> {{ $project->category->name }}</li>
                                @endif
                                @if($project->service)
                                    <li><strong>Service:</strong> {{ $project->service->title }}</li>
                                @endif
                                @if($project->project_date)
                                    <li><strong>Date:</strong> {{ $project->project_date->format('F Y') }}</li>
                                @endif
                                @if($project->project_url)
                                    <li><strong>URL:</strong> <a href="{{ $project->project_url }}" target="_blank">Visit</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        @if($project->tags->count())
                            <div class="widget">
                                <h4 class="widget_title">{{ setting('portfolio_tags_title', 'Tags') }}</h4>
                                <div class="sidebar__tag-list">
                                    <ul class="list-wrap">
                                        @foreach($project->tags as $tag)
                                            <li><a href="javascript:void(0)">{{ $tag->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </div>

    {{-- Testimonials for this project --}}
    @if($project->testimonials->count())
        <div class="testimonials-section space-bottom">
            <div class="container">
                <h3 class="mb-30">{{ setting('portfolio_testimonials_title', 'Client Testimonials') }}</h3>
                <div class="row gy-30">
                    @foreach($project->testimonials as $testimonial)
                        <div class="col-md-6">
                            <div class="testi-card p-4 border rounded">
                                <p class="mb-3">"{{ $testimonial->content }}"</p>
                                <strong>{{ $testimonial->name }}</strong>
                                @if($testimonial->designation)<br><small>{{ $testimonial->designation }},
                                {{ $testimonial->company }}</small>@endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- Related Projects --}}
    @if($relatedProjects->count())
        <div class="related-projects space-bottom">
            <div class="container">
                <h3 class="mb-30">{{ setting('portfolio_related_title', 'Related Projects') }}</h3>
                <div class="row gy-30">
                    @foreach($relatedProjects as $related)
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('portfolio.detail', $related->slug) }}" class="portfolio-wrap style2">
                                <div class="portfolio-thumb">
                                    <img src="{{ $related->image ? asset($related->image) : asset('assets/img/portfolio/portfolio2_1.jpg') }}"
                                        alt="{{ $related->title }}">
                                </div>
                                <div class="portfolio-details">
                                    <h3 class="portfolio-title">{{ $related->title }}</h3>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

@endsection