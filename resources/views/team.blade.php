@extends('layouts.app')

@section('title', 'Our Team - VMCore')
@section('meta_description', 'Meet the talented team behind VMCore.')

@section('content')
<!--==============================
    Breadcumb
    ============================== -->
    <div class="breadcumb-wrapper " data-bg-src="{{ asset('assets/img/bg/breadcumb-bg1-3.jpg') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Team</h1>
            </div>
        </div>
    </div>

    <!--==============================
    Team Area
    ==============================-->
    <div class="team-area-1 space overflow-hidden">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-lg-3 col-md-6">
                    <div class="team-card">
                        <div class="team-card_img">
                            <img src="{{ asset('assets/img/team/team-1-1.png') }}" alt="Team Image">
                        </div>
                        <div class="team-card_content">
                            <h3 class="team-card_title"><a href="{{ url('/team-details') }}">Daniyel Karlos</a></h3>
                            <span class="team-card_desig">Web Developer</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-card">
                        <div class="team-card_img">
                            <img src="{{ asset('assets/img/team/team-1-2.png') }}" alt="Team Image">
                        </div>
                        <div class="team-card_content">
                            <h3 class="team-card_title"><a href="{{ url('/team-details') }}">Daniyel Karlos</a></h3>
                            <span class="team-card_desig">Web Developer</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-card">
                        <div class="team-card_img">
                            <img src="{{ asset('assets/img/team/team-1-3.png') }}" alt="Team Image">
                        </div>
                        <div class="team-card_content">
                            <h3 class="team-card_title"><a href="{{ url('/team-details') }}">Daniyel Karlos</a></h3>
                            <span class="team-card_desig">Web Developer</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-card">
                        <div class="team-card_img">
                            <img src="{{ asset('assets/img/team/team-1-4.png') }}" alt="Team Image">
                        </div>
                        <div class="team-card_content">
                            <h3 class="team-card_title"><a href="{{ url('/team-details') }}">Daniyel Karlos</a></h3>
                            <span class="team-card_desig">Web Developer</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-card">
                        <div class="team-card_img">
                            <img src="{{ asset('assets/img/team/team-1-1.png') }}" alt="Team Image">
                        </div>
                        <div class="team-card_content">
                            <h3 class="team-card_title"><a href="{{ url('/team-details') }}">Daniyel Karlos</a></h3>
                            <span class="team-card_desig">Web Developer</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-card">
                        <div class="team-card_img">
                            <img src="{{ asset('assets/img/team/team-1-2.png') }}" alt="Team Image">
                        </div>
                        <div class="team-card_content">
                            <h3 class="team-card_title"><a href="{{ url('/team-details') }}">Daniyel Karlos</a></h3>
                            <span class="team-card_desig">Web Developer</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-card">
                        <div class="team-card_img">
                            <img src="{{ asset('assets/img/team/team-1-3.png') }}" alt="Team Image">
                        </div>
                        <div class="team-card_content">
                            <h3 class="team-card_title"><a href="{{ url('/team-details') }}">Daniyel Karlos</a></h3>
                            <span class="team-card_desig">Web Developer</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-card">
                        <div class="team-card_img">
                            <img src="{{ asset('assets/img/team/team-1-4.png') }}" alt="Team Image">
                        </div>
                        <div class="team-card_content">
                            <h3 class="team-card_title"><a href="{{ url('/team-details') }}">Daniyel Karlos</a></h3>
                            <span class="team-card_desig">Web Developer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--==============================
    Testimonial Area
    ==============================-->
    <div class="testimonial-area-1 space bg-theme">
        <div class="testimonial-img-1-1 shape-mockup wow img-custom-anim-right" data-wow-duration="1.5s" data-wow-delay="0.2s" data-right="0" data-top="-100px" data-bottom="140px">
            <img src="{{ asset('assets/img/testimonial/testi_thumb1_1.jpg') }}" alt="img">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="title-area">
                        <h2 class="sec-title">Testimonials</h2>
                    </div>
                    <div class="quote-icon">
                        <img src="{{ asset('assets/img/icon/quote.svg') }}" alt="icon">
                    </div>
                    <div class="row global-carousel testi-slider1" data-slide-show="1" data-dots="true" data-xl-dots="true" data-ml-dots="true">
                        <div class="col-lg-4">
                            <div class="testi-box">
                                <p class="testi-box_text">“It’s a pleasure working with Bunker. They understood our new brand positioning guidelines and translated them beautifully and consistently into our on-going marketing comms. The team is responsive, quick and always willing help winning partnership”</p>
                                <div class="testi-box_profile">
                                    <h4 class="testi-box_name">Daniyel Karlos</h4>
                                    <span class="testi-box_desig">Senior Director of Marketing</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="testi-box">
                                <p class="testi-box_text">“It’s a pleasure working with Bunker. They understood our new brand positioning guidelines and translated them beautifully and consistently into our on-going marketing comms. The team is responsive, quick and always willing help winning partnership”</p>
                                <div class="testi-box_profile">
                                    <h4 class="testi-box_name">Daniyel Karlos</h4>
                                    <span class="testi-box_desig">Senior Director of Marketing</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="testi-box">
                                <p class="testi-box_text">“It’s a pleasure working with Bunker. They understood our new brand positioning guidelines and translated them beautifully and consistently into our on-going marketing comms. The team is responsive, quick and always willing help winning partnership”</p>
                                <div class="testi-box_profile">
                                    <h4 class="testi-box_name">Daniyel Karlos</h4>
                                    <span class="testi-box_desig">Senior Director of Marketing</span>
                                </div>
                            </div>
                        </div>
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
                <h6 class="item m-item"><a href="#"><i class="fas fa-star-of-life"></i> We Give Unparalleled Flexibility</a></h6>
                <h6 class="item m-item"><a href="#"><i class="fas fa-star-of-life"></i> We Give Unparalleled Flexibility</a></h6>
                <h6 class="item m-item"><a href="#"><i class="fas fa-star-of-life"></i> We Give Unparalleled Flexibility</a></h6>
                <h6 class="item m-item"><a href="#"><i class="fas fa-star-of-life"></i> We Give Unparalleled Flexibility</a></h6>
            </div>
        </div>
    </div>

@endsection
