@extends('layouts.app')

@section('title', 'Portfolio - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', \App\Models\Setting::get('portfolio_meta_description', 'Explore our portfolio of projects and case studies.'))

@section('content')

    <!--==============================
                        Breadcumb
                        ============================== -->
    <div class="breadcumb-wrapper"
        data-bg-src="{!! \App\Models\Setting::get('portfolio_hero_image') ? asset(\App\Models\Setting::get('portfolio_hero_image')) : asset('assets/img/bg/breadcumb-bg1-5.jpg') !!}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{!! \App\Models\Setting::get('portfolio_breadcrumb_title', 'Portfolio') !!}</h1>
            </div>
        </div>
    </div>

    <!--==============================
                        Portfolio Area
                        ==============================-->
    <div class="portfolio-area-1 space overflow-hidden">
        <div class="container">
            {{-- Category filter --}}
            @if($categories->count())
                <div class="row justify-content-center mb-40">
                    <div class="col-12 text-center">
                        <div class="portfolio-filter">
                            <a href="{{ route('portfolio') }}" class="btn {{ !request('category') ? 'active' : '' }}"
                                style="margin:5px;">All</a>
                            @foreach($categories as $cat)
                                <a href="{{ route('portfolio', ['category' => $cat->slug]) }}"
                                    class="btn {{ request('category') == $cat->slug ? 'active' : '' }}"
                                    style="margin:5px;">{{ $cat->name }} ({{ $cat->projects_count }})</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <div class="row gy-30">
                @forelse($projects as $project)
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('portfolio.detail', $project->slug) }}" class="portfolio-wrap style2">
                            <div class="portfolio-thumb">
                                <img src="{{ $project->image ? asset($project->image) : asset('assets/img/portfolio/portfolio2_1.jpg') }}"
                                    alt="{{ $project->title }}">
                            </div>
                            <div class="portfolio-details">
                                <ul class="portfolio-meta">
                                    <li>{{ $project->categories->count() ? $project->categories->pluck('title')->implode(', ') : 'Uncategorized' }}
                                    </li>
                                </ul>
                                <h3 class="portfolio-title">{{ $project->title }}</h3>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No projects found.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($projects->hasPages())
                <div class="pagination-wrap mt-50">
                    {{ $projects->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

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