@extends('layouts.app')

@section('title', ($project->meta_title ?? $project->title) . ' - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', $project->meta_description ?? $project->short_description ?? '')

@section('content')

    @push('styles')
        <style>
            /* Modern Portfolio Sidebar Styling */
            .custom-project-sidebar .custom-widget-box {
                background: #ffffff;
                border-radius: 16px;
                padding: 32px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
                border: 1px solid var(--theme-color);
                margin-bottom: 30px;
                position: relative;
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .custom-project-sidebar .custom-widget-box:hover {
                box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
            }

            .custom-project-sidebar .custom-widget-title {
                font-size: 1.25rem;
                font-weight: 700;
                color: var(--title-color);
                margin-bottom: 24px;
                position: relative;
                padding-bottom: 12px;
                border: none;
            }

            .custom-project-sidebar .custom-widget-title::after {
                content: '';
                position: absolute;
                left: 0;
                bottom: 0;
                width: 40px;
                height: 3px;
                background: var(--theme-color);
                border-radius: 10px;
            }

            .custom-project-info-list {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .custom-project-info-list li {
                display: flex;
                align-items: flex-start;
                gap: 16px;
                padding: 16px 0;
                border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
            }

            .custom-project-info-list li:last-child {
                border-bottom: none;
                padding-bottom: 0;
            }

            .custom-project-info-list li:first-child {
                padding-top: 0;
            }

            .custom-project-info-list .icon-wrapper {
                flex-shrink: 0;
                width: 48px;
                height: 48px;
                border-radius: 12px;
                background: rgba(0, 0, 0, 0.03);
                color: var(--theme-color);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.25rem;
                transition: all 0.3s ease;
            }

            .custom-project-info-list li:hover .icon-wrapper {
                background: var(--theme-color);
                color: #ffffff;
                transform: translateY(-3px) scale(1.05);
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            }

            .custom-project-info-list .content-wrapper {
                flex-grow: 1;
            }

            .custom-project-info-list .label {
                display: block;
                font-size: 0.75rem;
                text-transform: uppercase;
                font-weight: 700;
                color: var(--body-color);
                opacity: 0.6;
                letter-spacing: 1px;
                margin-bottom: 4px;
            }

            .custom-project-info-list .value {
                display: block;
                font-size: 1rem;
                font-weight: 600;
                color: var(--title-color);
            }

            .custom-project-info-list .btn-live-preview {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: var(--theme-color);
                color: #ffffff !important;
                padding: 10px 24px;
                border-radius: 50px;
                font-size: 0.875rem;
                font-weight: 600;
                text-decoration: none;
                margin-top: 8px;
                transition: all 0.3s ease;
                border: 2px solid transparent;
            }

            .custom-project-info-list .btn-live-preview:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
                background: #ffffff;
                color: var(--theme-color) !important;
                border-color: var(--theme-color);
            }

            .custom-project-info-list .btn-live-preview i {
                transition: transform 0.3s ease;
            }

            .custom-project-info-list .btn-live-preview:hover i {
                transform: translateX(4px);
            }

            .custom-tags-wrap {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-top: 10px;
            }

            .custom-tags-wrap a {
                display: inline-flex;
                align-items: center;
                padding: 8px 16px;
                background: rgba(0, 0, 0, 0.03);
                color: var(--title-color);
                font-size: 0.85rem;
                font-weight: 500;
                border-radius: 8px;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .custom-tags-wrap a:hover {
                background: var(--theme-color);
                color: #ffffff;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            /* Dark theme accommodations */
            body.dark-theme .custom-project-sidebar .custom-widget-box {
                background: #181824;
                border-color: rgba(255, 255, 255, 0.05);
            }

            body.dark-theme .custom-project-info-list li {
                border-bottom-color: rgba(255, 255, 255, 0.05);
            }

            body.dark-theme .custom-project-info-list .icon-wrapper,
            body.dark-theme .custom-tags-wrap a {
                background: rgba(255, 255, 255, 0.05);
            }

            body.dark-theme .custom-tags-wrap a:hover {
                background: var(--theme-color);
            }

            /* Mobile Layout Fixes */
            @media (max-width: 991.98px) {
                .custom-project-sidebar {
                    margin-top: 40px;
                }
            }
        </style>
    @endpush

    <!--==============================
                                                                                    Breadcumb
                                                                                    ============================== -->
    <div class="breadcumb-wrapper"
        data-bg-src="{{ $project->banner_image ? asset($project->banner_image) : asset($project->image) }}">
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
                            <h4 class="mb-20">{!! setting('portfolio_gallery_title', 'Project Gallery') !!}</h4>
                            <div class="row gy-20">
                                @foreach($project->images as $img)
                                    <div class="col-md-4 col-6">
                                        <a href="{{ asset($img->image) }}" class="popup-image">
                                            <img src="{{ asset($img->image) }}" alt="Gallery" class="w-100">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <aside class="project-sidebar custom-project-sidebar">
                        <div class="widget project-info-box custom-widget-box">
                            <h4 class="widget_title custom-widget-title">
                                {!! setting('portfolio_info_title', 'Project Info') !!}
                            </h4>
                            <ul class="project-info-list custom-project-info-list">
                                @if($project->client)
                                    <li>
                                        <div class="icon-wrapper">
                                            <i class="far fa-user"></i>
                                        </div>
                                        <div class="content-wrapper">
                                            <span class="label">Client</span>
                                            <span class="value">{{ $project->client }}</span>
                                        </div>
                                    </li>
                                @endif
                                @if($project->category)
                                    <li>
                                        <div class="icon-wrapper">
                                            <i class="far fa-folder-open"></i>
                                        </div>
                                        <div class="content-wrapper">
                                            <span class="label">Category</span>
                                            <span class="value">{{ $project->category->name }}</span>
                                        </div>
                                    </li>
                                @endif
                                @if($project->service)
                                    <li>
                                        <div class="icon-wrapper">
                                            <i class="fas fa-layer-group"></i>
                                        </div>
                                        <div class="content-wrapper">
                                            <span class="label">Service</span>
                                            <span class="value">{{ $project->service->title }}</span>
                                        </div>
                                    </li>
                                @endif
                                @if($project->project_date)
                                    <li>
                                        <div class="icon-wrapper">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                        <div class="content-wrapper">
                                            <span class="label">Date</span>
                                            <span class="value">{{ $project->project_date->format('F Y') }}</span>
                                        </div>
                                    </li>
                                @endif
                                @if($project->project_url)
                                    <li>
                                        <div class="icon-wrapper">
                                            <i class="fas fa-link"></i>
                                        </div>
                                        <div class="content-wrapper">
                                            <span class="label">Live URL</span>
                                            <a href="{{ $project->project_url }}" target="_blank" class="btn-live-preview">
                                                Visit Project <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        @if($project->tags->count())
                            <div class="widget custom-widget-box">
                                <h4 class="widget_title custom-widget-title">{!! setting('portfolio_tags_title', 'Tags') !!}
                                </h4>
                                <div class="sidebar__tag-list custom-tags-wrap">
                                    @foreach($project->tags as $tag)
                                        <a href="javascript:void(0)">
                                            <i class="fas fa-hashtag"
                                                style="font-size: 0.75rem; margin-right: 3px; opacity: 0.7;"></i>{{ $tag->title }}
                                        </a>
                                    @endforeach
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
                <h3 class="mb-30">{!! setting('portfolio_testimonials_title', 'Client Testimonials') !!}</h3>
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
                <h3 class="mb-30">{!! setting('portfolio_related_title', 'Related Projects') !!}</h3>
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