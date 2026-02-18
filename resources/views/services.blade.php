@extends('layouts.app')

@section('title', 'Services - VMCore')
@section('meta_description', 'VMCore offers a wide range of services including Branding, Web Development, Digital
    Marketing, and more.')

@section('content')

    <!--==============================
        Breadcumb
        ============================== -->
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('assets/img/bg/breadcumb-bg1-2.jpg') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Service</h1>
            </div>
        </div>
    </div>

    <!--==============================
        Feature Area
        ==============================-->
    <div class="feature-area-1 space">
        <div class="container">
            <div class="row gy-4 align-items-center justify-content-center">
                <div class="col-xxl-6 col-xl-6">
                    <div class="feature-card style-grid">
                        <div class="feature-card-icon">
                            <img src="{{ asset('assets/img/icon/feature-icon1-1.svg') }}" alt="icon">
                        </div>
                        <div class="feature-card-details">
                            <h4 class="feature-card-title">
                                <a href="{{ url('/services') }}">Branding Design</a>
                            </h4>
                            <p class="feature-card-text">Good website tells a story that will make users fully immerse
                                themselves operating</p>
                            <a href="{{ url('/services') }}" class="link-btn">
                                <span class="link-effect">
                                    <span class="effect-1">VIEW DETAILS</span>
                                    <span class="effect-1">VIEW DETAILS</span>
                                </span>
                                <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6">
                    <div class="feature-card style-grid">
                        <div class="feature-card-icon">
                            <img src="{{ asset('assets/img/icon/feature-icon1-2.svg') }}" alt="icon">
                        </div>
                        <div class="feature-card-details">
                            <h4 class="feature-card-title">
                                <a href="{{ url('/services') }}">Web Development</a>
                            </h4>
                            <p class="feature-card-text">Good website tells a story that will make users fully immerse
                                themselves operating</p>
                            <a href="{{ url('/services') }}" class="link-btn">
                                <span class="link-effect">
                                    <span class="effect-1">VIEW DETAILS</span>
                                    <span class="effect-1">VIEW DETAILS</span>
                                </span>
                                <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6">
                    <div class="feature-card style-grid">
                        <div class="feature-card-icon">
                            <img src="{{ asset('assets/img/icon/feature-icon1-4.svg') }}" alt="icon">
                        </div>
                        <div class="feature-card-details">
                            <h4 class="feature-card-title">
                                <a href="{{ url('/services') }}">Digital Marketing</a>
                            </h4>
                            <p class="feature-card-text">Good website tells a story that will make users fully immerse
                                themselves operating</p>
                            <a href="{{ url('/services') }}" class="link-btn">
                                <span class="link-effect">
                                    <span class="effect-1">VIEW DETAILS</span>
                                    <span class="effect-1">VIEW DETAILS</span>
                                </span>
                                <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6">
                    <div class="feature-card style-grid">
                        <div class="feature-card-icon">
                            <img src="{{ asset('assets/img/icon/feature-icon1-3.svg') }}" alt="icon">
                        </div>
                        <div class="feature-card-details">
                            <h4 class="feature-card-title">
                                <a href="{{ url('/services') }}">Illustration Modelling</a>
                            </h4>
                            <p class="feature-card-text">Good website tells a story that will make users fully immerse
                                themselves operating</p>
                            <a href="{{ url('/services') }}" class="link-btn">
                                <span class="link-effect">
                                    <span class="effect-1">VIEW DETAILS</span>
                                    <span class="effect-1">VIEW DETAILS</span>
                                </span>
                                <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6">
                    <div class="feature-card style-grid">
                        <div class="feature-card-icon">
                            <img src="{{ asset('assets/img/icon/feature-icon1-5.svg') }}" alt="icon">
                        </div>
                        <div class="feature-card-details">
                            <h4 class="feature-card-title">
                                <a href="{{ url('/services') }}">Social Advertising</a>
                            </h4>
                            <p class="feature-card-text">Good website tells a story that will make users fully immerse
                                themselves operating</p>
                            <a href="{{ url('/services') }}" class="link-btn">
                                <span class="link-effect">
                                    <span class="effect-1">VIEW DETAILS</span>
                                    <span class="effect-1">VIEW DETAILS</span>
                                </span>
                                <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6">
                    <div class="feature-card style-grid">
                        <div class="feature-card-icon">
                            <img src="{{ asset('assets/img/icon/feature-icon1-6.svg') }}" alt="icon">
                        </div>
                        <div class="feature-card-details">
                            <h4 class="feature-card-title">
                                <a href="{{ url('/services') }}">Content Marketing</a>
                            </h4>
                            <p class="feature-card-text">Good website tells a story that will make users fully immerse
                                themselves operating</p>
                            <a href="{{ url('/services') }}" class="link-btn">
                                <span class="link-effect">
                                    <span class="effect-1">VIEW DETAILS</span>
                                    <span class="effect-1">VIEW DETAILS</span>
                                </span>
                                <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--==============================
        Contact Area
        ==============================-->
    <div class="contact-area-1 space bg-theme">
        <div class="contact-map shape-mockup wow img-custom-anim-left" data-wow-duration="1.5s" data-wow-delay="0.2s"
            data-left="0" data-top="-100px" data-bottom="140px">
            <iframe
                src="https://maps.google.com/maps?q=London%20Eye%2C%20London%2C%20United%20Kingdom&t=m&z=10&output=embed&iwloc=near"
                allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-end">
                <div class="col-lg-6">
                    <div class="contact-form-wrap">
                        <div class="title-area mb-30">
                            <h2 class="sec-title">Have Any Project on Your Mind?</h2>
                            <p>Great! We're excited to hear from you and let's start something</p>
                        </div>
                        <form action="{{ url('/contact') }}" method="POST" class="contact-form ajax-contact">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control style-border" name="name"
                                            id="name" placeholder="Full name*">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control style-border" name="email"
                                            id="email" placeholder="Email address*">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control style-border" name="website"
                                            id="website" placeholder="Website link">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea name="message" placeholder="How Can We Help You*" id="contactForm" class="form-control style-border"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-btn col-12">
                                <button type="submit" class="btn mt-20">
                                    <span class="link-effect">
                                        <span class="effect-1">SEND MESSAGE</span>
                                        <span class="effect-1">SEND MESSAGE</span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--==============================
        Marquee Area
        ==============================-->
    <div class="container-fluid p-0 overflow-hidden">
        <div class="slider__marquee clearfix marquee-wrap">
            <div class="marquee_mode marquee__group">
                <h6 class="item m-item"><a href="#"><i class="fas fa-star-of-life"></i> We Give Unparalleled
                        Flexibility</a></h6>
                <h6 class="item m-item"><a href="#"><i class="fas fa-star-of-life"></i> We Give Unparalleled
                        Flexibility</a></h6>
                <h6 class="item m-item"><a href="#"><i class="fas fa-star-of-life"></i> We Give Unparalleled
                        Flexibility</a></h6>
                <h6 class="item m-item"><a href="#"><i class="fas fa-star-of-life"></i> We Give Unparalleled
                        Flexibility</a></h6>
            </div>
        </div>
    </div>

@endsection
