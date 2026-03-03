@extends('layouts.app')

@section('title', $siteSettings['meta_title'] ?? 'VMCore - Creative Digital Agency')
@section('meta_description', $siteSettings['meta_description'] ?? 'VMCore - We build creative digital experiences for your brand')

@section('content')

    <!--==============================
                            Hero Area
                            ==============================-->
    <div class="hero-wrapper hero-2" id="hero">
        <div class="hero-2-thumb wow img-custom-anim-right" data-wow-duration="1.5s" data-wow-delay="0.2s">
            @if($hero && $hero->image)
                <img src="{{ asset($hero->image) }}" alt="{{ $hero->title ?? 'Hero' }}">
            @else
                <img src="{{ asset('assets/img/hero/hero-2-1.jpg') }}" alt="img">
            @endif
        </div>
        <div class="container">
            <div class="hero-style2">
                <div class="row">
                    <div class="col-lg-9">
                        @if($hero)
                                @php
                                    $titleParts = explode("\n", $hero->title ?? "We Make\nCreative Things\nEveryday");
                                @endphp
                                <h1 class="hero-title wow img-custom-anim-right text-white">{{ $titleParts[0] ?? 'We Make' }}</h1>
                                <h1 class="hero-title wow img-custom-anim-left text-white">{{ $titleParts[1] ?? 'Creative Things' }}
                                </h1>
                            </div>
                            <div class="col-lg-10 offset-lg-2">
                                <h1 class="hero-title wow img-custom-anim-right text-white">{{ $titleParts[2] ?? 'Everyday' }}</h1>
                            </div>
                            <div class="col-xxl-4 col-xl-5 col-lg-6">
                                <p class="hero-text wow img-custom-anim-left text-white">{{ $hero->subtitle ?? '' }}</p>
                        @else
                            </div>
                            <div class="col-lg-10 offset-lg-2">
                                <h1 class="hero-title wow img-custom-anim-right text-white">Everyday</h1>
                            </div>
                            <div class="col-xxl-4 col-xl-5 col-lg-6">
                                <p class="hero-text wow img-custom-anim-left text-white">We are digital agency that helps immersive
                                    and engaging user experiences that</p>
                        @endif
                        <div class="btn-group fade_left">
                            <a href="{{ route('portfolio') }}" class="btn style2 wow img-custom-anim-left">
                                <span class="link-effect">
                                    <span class="effect-1">{{ $hero->button_text ?? 'VIEW OUR WORKS' }}</span>
                                    <span class="effect-1">{{ $hero->button_text ?? 'VIEW OUR WORKS' }}</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- <div class="row justify-content-end">
                    <div class="col-xxl-6 col-xl-7 col-lg-9">
                        <div class="wow img-custom-anim-right">
                            <div class="hero-contact-wrap">
                                {{ $siteSettings['site_address'] ?? '' }}
                            </div>
                            <div class="hero-contact-wrap">
                                @if(!empty($siteSettings['site_phone']))
                                    <a
                                        href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['site_phone']) }}">{{ $siteSettings['site_phone'] }}</a>
                                @endif
                                @if(!empty($siteSettings['site_email']))
                                    <a href="mailto:{{ $siteSettings['site_email'] }}">{{ $siteSettings['site_email'] }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!--======== / Hero Section ========-->

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

    <!--==============================
                            Feature / Services Area
                            ==============================-->
    @if($services->count())
        <div class="feature-area-1 space">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="title-area text-center">
                            <h2 class="sec-title">{!! setting('home_services_title', 'What We Can Do for Our Clients') !!}</h2>
                        </div>
                    </div>
                </div>
                <div class="row gy-4 align-items-center justify-content-center">
                    @foreach($services as $service)
                        <div class="col-xxl-5 col-md-6">
                            <div class="feature-card">
                                <div class="feature-card-icon">
                                    @if($service->icon)
                                        <i class="{{ $service->icon }}" style="font-size:48px;"></i>
                                    @elseif($service->image)
                                        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}">
                                    @else
                                        <img src="{{ asset('assets/img/icon/feature-icon1-1.svg') }}" alt="icon">
                                    @endif
                                </div>
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
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!--==============================
                            Skills / Service Area
                            ==============================-->
    @if($skills->count())
        <div class="service-area-1 space bg-theme">
            <div class="service-img-1-1 shape-mockup wow img-custom-anim-left" data-wow-duration="1.5s" data-wow-delay="0.2s"
                data-left="0" data-top="-100px" data-bottom="140px">
                <img src="{{ asset(setting('home_skills_bg', 'assets/img/normal/service_2-1.jpg')) }}" alt="img">
            </div>
            <div class="container">
                <div class="row align-items-center justify-content-end">
                    <div class="col-lg-6">
                        <div class="about-content-wrap">
                            <div class="title-area mb-0">
                                <h2 class="sec-title">{!! setting('home_skills_title', 'We Offer a Wide Range of Brand Services') !!}</h2>
                                <p class="sec-text mt-35 mb-40">{!! setting('home_skills_subtitle', 'We are a creative agency working with brands building insightful strategy, creating unique designs and crafting value') !!}</p>
                                @foreach($skills as $skill)
                                    <div class="skill-feature">
                                        <h3 class="skill-feature_title">{{ $skill->title }}</h3>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: {{ $skill->percentage }}%;">
                                            </div>
                                            <div class="progress-value"><span
                                                    class="counter-number">{{ $skill->percentage }}</span>%</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!--==============================
                                Portfolio Area
                            ==============================-->
    @if($projects->count())
        <div class="portfolio-area-1 space overflow-hidden">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9">
                        <div class="title-area text-center">
                            <h2 class="sec-title">{!! setting('home_portfolio_title', 'Discover Our Selected Projects') !!}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid p-0">
                <div class="row global-carousel gx-60 portfolio-slider" data-slide-show="1" data-center-mode="true"
                    data-xl-center-mode="true" data-ml-center-mode="true" data-lg-center-mode="true" data-center-padding="600px"
                    data-xl-center-padding="400px" data-ml-center-padding="400px" data-lg-center-padding="300px"
                    data-dots="true" data-xl-dots="true" data-ml-dots="true">
                    @foreach($projects as $project)
                        <div class="col-lg-4">
                            <a href="{{ route('portfolio.detail', $project->slug) }}" class="portfolio-wrap style2">
                                <div class="portfolio-thumb">
                                    <img src="{{ $project->image ? asset($project->image) : asset('assets/img/portfolio/portfolio2_1.jpg') }}"
                                        alt="{{ $project->title }}">
                                </div>
                                <div class="portfolio-details">
                                    <ul class="portfolio-meta">
                                        <li>{{ $project->category->name ?? 'Uncategorized' }}</li>
                                    </ul>
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
                            Award Area
                            ==============================-->
    @if($awards->count())
        <div class="award-area-1 space-bottom overflow-hidden">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <ul class="award-wrap-area">
                            @foreach($awards as $award)
                                <li class="single-award-list">
                                    <span class="award-year">{{ $award->year }}</span>
                                    <div class="award-details">
                                        <h4><a href="{{ route('about') }}">{{ $award->title }}</a></h4>
                                        <p>{{ $award->description }}</p>
                                    </div>
                                    <span class="award-tag">{{ $award->tag ?? 'Award' }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!--==============================
                            Video Area
                            ==============================-->
    <div class="video-area-1 overflow-hidden">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="video-wrap">
                        <div class="jarallax" data-bg-src="{{ asset(setting('home_video_bg', 'assets/img/normal/video_2-1.jpg')) }}">
                        </div>
                        <a href="{{ $siteSettings['video_url'] ?? 'https://www.youtube.com/watch?v=vvNwlRLjLkU' }}"
                            class="play-btn circle-btn btn gsap-magnetic popup-video background-image">PLAY VIDEO
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--==============================
                            Blog Area
                            ==============================-->
    @if($posts->count())
        <section class="blog-area space">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-7 col-xl-6 col-lg-8">
                        <div class="title-area text-center">
                            <h2 class="sec-title">{!! setting('home_blog_title', 'Read Our Articles and News') !!}</h2>
                        </div>
                    </div>
                </div>
                <div class="row gy-30 justify-content-center">
                    @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('blog.detail', $post->slug) }}" class="blog-card style2">
                                <div class="blog-img">
                                    <img src="{{ $post->image ? asset($post->image) : asset('assets/img/blog/blog_2_1.png') }}"
                                        alt="{{ $post->title }}">
                                </div>
                                <div class="blog-content">
                                    <div class="post-meta-item blog-meta">
                                        <span>{{ ($post->published_at ?? $post->created_at)->format('F d, Y') }}</span>
                                        <span>{{ $post->category->name ?? 'Uncategorized' }}</span>
                                    </div>
                                    <h4 class="blog-title">{{ $post->title }}</h4>
                                    <span class="link-btn">
                                        <span class="link-effect">
                                            <span class="effect-1">READ MORE</span>
                                            <span class="effect-1">READ MORE</span>
                                        </span>
                                        <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!--==============================
                            Client Area
                            ==============================-->
    @if($clients->count())
        <div class="client-area-1 overflow-hidden space-bottom mt-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <ul class="client-list-wrap">
                            @foreach($clients as $client)
                                <li>
                                    <a href="{{ $client->url ?? 'javascript:void(0)' }}" @if($client->url) target="_blank" @endif>
                                        <span class="link-effect">
                                            <span class="effect-1"><img
                                                    src="{{ $client->logo ? asset($client->logo) : asset('assets/img/client/client-1-1.svg') }}"
                                                    alt="{{ $client->name }}"></span>
                                            <span class="effect-1"><img
                                                    src="{{ $client->logo ? asset($client->logo) : asset('assets/img/client/client-1-1.svg') }}"
                                                    alt="{{ $client->name }}"></span>
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!--==============================
                            CTA Area
                            ==============================-->
    <div class="cta-area-1 overflow-hidden bg-theme space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    <div class="title-area text-center mb-0">
                        <h2 class="sec-title">{!! setting('home_cta_title', "Let's Create Something Great") !!}</h2>
                        <p class="sec-text mt-30 mb-40">{!! setting('home_cta_subtitle', "We shift you from today's reality to tomorrow's potential, ensuring") !!}</p>
                        <div class="btn-group justify-content-center">
                            <a href="{{ route('contact') }}" class="btn mt-0">
                                <span class="link-effect">
                                    <span class="effect-1">LET'S TALK WITH US</span>
                                    <span class="effect-1">LET'S TALK WITH US</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

