@extends('layouts.app')

@section('title', 'Services - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', 'Explore our professional services including web development, branding, digital marketing and more.')

@section('content')

    <!--==============================
                Breadcumb
                ============================== -->
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('assets/img/bg/breadcumb-bg1-2.jpg') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Services</h1>
            </div>
        </div>
    </div>

    <!--==============================
                Feature Area
                ==============================-->
    <div class="feature-area-1 space">
        <div class="container">
            <div class="row gy-4 align-items-center justify-content-center">
                @forelse($services as $service)
                    <div class="col-xxl-6 col-xl-6">
                        <div class="feature-card style-grid">
                            <div class="feature-card-icon">
                                @if($service->icon)
                                    <i class="{{ $service->icon }}" style="font-size:48px;"></i>
                                @elseif($service->image)
                                    <img src="{{ asset($service->image) }}" alt="{{ $service->title }}">
                                @else
                                    <img src="{{ asset('assets/img/icon/feature-icon1-1.svg') }}" alt="icon">
                                @endif
                            </div>
                            <div class="feature-card-details">
                                <h4 class="feature-card-title">
                                    <a href="{{ route('service.detail', $service->slug) }}">{{ $service->title }}</a>
                                </h4>
                                <p class="feature-card-text">{{ $service->short_description }}</p>
                                <a href="{{ route('service.detail', $service->slug) }}" class="link-btn">
                                    <span class="link-effect">
                                        <span class="effect-1">VIEW DETAILS</span>
                                        <span class="effect-1">VIEW DETAILS</span>
                                    </span>
                                    <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No services available at the moment.</p>
                    </div>
                @endforelse
            </div>
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