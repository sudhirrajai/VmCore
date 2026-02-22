@extends('layouts.app')

@section('title', 'About Us - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', 'Learn about our team, skills, and achievements.')

@section('content')

    <!--==============================
                Breadcumb
                ============================== -->
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('assets/img/bg/breadcumb-bg1-3.jpg') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">About Us</h1>
            </div>
        </div>
    </div>

    <!--==============================
                About Section
                ==============================-->
    <div class="about-area space">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-thumb wow img-custom-anim-left">
                        <img src="{{ asset('assets/img/normal/about_2-1.jpg') }}" alt="About us">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content-wrap">
                        <div class="title-area mb-0">
                            <h2 class="sec-title">{{ $siteSettings['about_title'] ?? 'We Are Creative Digital Agency' }}
                            </h2>
                            <p class="sec-text mt-30">
                                {{ $siteSettings['about_description'] ?? 'We believe that building great things starts with a deep understanding and a commitment to quality.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--==============================
                Skills Area
                ==============================-->
    @if($skills->count())
        <div class="service-area-1 space bg-theme">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="about-content-wrap">
                            <div class="title-area mb-0">
                                <h2 class="sec-title text-center">Our Expertise</h2>
                                <div class="mt-40">
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
        </div>
    @endif

    <!--==============================
                Team Area
                ==============================-->
    @if($team->count())
        <div class="team-area space">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="title-area text-center">
                            <h2 class="sec-title">Meet Our Creative Team</h2>
                        </div>
                    </div>
                </div>
                <div class="row gy-40 justify-content-center">
                    @foreach($team as $member)
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="team-card text-center">
                                <div class="team-card_img">
                                    <a href="{{ route('team.detail', $member->slug) }}">
                                        <img src="{{ $member->image ? asset($member->image) : asset('assets/img/team/team_1_1.jpg') }}"
                                            alt="{{ $member->name }}">
                                    </a>
                                </div>
                                <div class="team-card_content">
                                    <h4 class="team-card_title"><a
                                            href="{{ route('team.detail', $member->slug) }}">{{ $member->name }}</a></h4>
                                    <span class="team-card_desig">{{ $member->designation }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!--==============================
                Awards Area
                ==============================-->
    @if($awards->count())
        <div class="award-area-1 space-bottom overflow-hidden">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="title-area text-center">
                            <h2 class="sec-title">Awards & Recognition</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <ul class="award-wrap-area">
                            @foreach($awards as $award)
                                <li class="single-award-list">
                                    <span class="award-year">{{ $award->year }}</span>
                                    <div class="award-details">
                                        <h4>{{ $award->title }}</h4>
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
                Testimonials Area
                ==============================-->
    @if($testimonials->count())
        <div class="testimonials-area space bg-smoke">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="title-area text-center">
                            <h2 class="sec-title">What Our Clients Say</h2>
                        </div>
                    </div>
                </div>
                <div class="row gy-30 justify-content-center">
                    @foreach($testimonials as $testimonial)
                        <div class="col-lg-4 col-md-6">
                            <div class="testi-card p-4 bg-white rounded shadow-sm h-100">
                                <div class="testi-card_rating mb-15">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-half-alt' }}"
                                            style="color: #ffc107;"></i>
                                    @endfor
                                </div>
                                <p class="testi-card_text">"{{ $testimonial->content }}"</p>
                                <div class="testi-card_author mt-20">
                                    <strong>{{ $testimonial->name }}</strong>
                                    @if($testimonial->designation)<br><small
                                    class="text-muted">{{ $testimonial->designation }}{{ $testimonial->company ? ', ' . $testimonial->company : '' }}</small>@endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!--==============================
                Clients Area
                ==============================-->
    @if($clients->count())
        <div class="client-area-1 overflow-hidden space">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                        <div class="title-area text-center">
                            <h2 class="sec-title">Our Clients</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <ul class="client-list-wrap">
                            @foreach($clients as $client)
                                <li>
                                    <a href="{{ $client->url ?? '#' }}" @if($client->url) target="_blank" @endif>
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
                Marquee Area
                ==============================-->
    <div class="container-fluid p-0 overflow-hidden">
        <div class="slider__marquee clearfix marquee-wrap">
            <div class="marquee_mode marquee__group">
                @for($i = 0; $i < 4; $i++)
                    <h6 class="item m-item"><a href="#"><i class="fas fa-star-of-life"></i>
                            {{ $siteSettings['marquee_text'] ?? 'We Give Unparalleled Flexibility' }}</a></h6>
                @endfor
            </div>
        </div>
    </div>

@endsection