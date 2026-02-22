@extends('layouts.app')

@section('title', ($service->meta_title ?? $service->title) . ' - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', $service->meta_description ?? $service->short_description ?? '')

@section('content')

    <!--==============================
        Breadcumb
        ============================== -->
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('assets/img/bg/breadcumb-bg1-2.jpg') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{{ $service->title }}</h1>
            </div>
        </div>
    </div>

    <!--==============================
        Service Details
        ==============================-->
    <div class="service-details space">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if($service->image)
                    <div class="service-details-thumb mb-40">
                        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}">
                    </div>
                    @endif
                    <h2 class="service-details-title">{{ $service->title }}</h2>
                    @if($service->short_description)
                    <p class="mt-15 mb-30">{{ $service->short_description }}</p>
                    @endif
                    @if($service->description)
                    <div class="service-details-content mt-30">
                        {!! $service->description !!}
                    </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <aside class="service-sidebar">
                        <div class="widget">
                            <h4 class="widget_title">All Services</h4>
                            <ul class="service-menu list-wrap">
                                @foreach($relatedServices as $related)
                                <li><a href="{{ route('service.detail', $related->slug) }}">{{ $related->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget">
                            <h4 class="widget_title">Need Help?</h4>
                            <div class="sidebar-contact">
                                @if(!empty($siteSettings['site_phone']))
                                <p><i class="fas fa-phone"></i> <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['site_phone']) }}">{{ $siteSettings['site_phone'] }}</a></p>
                                @endif
                                @if(!empty($siteSettings['site_email']))
                                <p><i class="fas fa-envelope"></i> <a href="mailto:{{ $siteSettings['site_email'] }}">{{ $siteSettings['site_email'] }}</a></p>
                                @endif
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

    <!--==============================
        Related Projects
        ==============================-->
    @if($service->projects->count())
    <div class="related-projects space-bottom">
        <div class="container">
            <h3 class="mb-30">Related Projects</h3>
            <div class="row gy-30">
                @foreach($service->projects->take(3) as $project)
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('portfolio.detail', $project->slug) }}" class="portfolio-wrap style2">
                        <div class="portfolio-thumb">
                            <img src="{{ $project->image ? asset($project->image) : asset('assets/img/portfolio/portfolio2_1.jpg') }}" alt="{{ $project->title }}">
                        </div>
                        <div class="portfolio-details">
                            <h3 class="portfolio-title">{{ $project->title }}</h3>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!--==============================
        Marquee Area
        ==============================-->
    <div class="container-fluid p-0 overflow-hidden">
        <div class="slider__marquee clearfix marquee-wrap">
            <div class="marquee_mode marquee__group">
                @for($i = 0; $i < 4; $i++)
                <h6 class="item m-item"><a href="#"><i class="fas fa-star-of-life"></i> {{ $siteSettings['marquee_text'] ?? 'We Give Unparalleled Flexibility' }}</a></h6>
                @endfor
            </div>
        </div>
    </div>

@endsection
