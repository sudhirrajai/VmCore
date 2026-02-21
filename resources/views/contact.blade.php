@extends('layouts.app')

@section('title', 'Contact Us - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', 'Get in touch with us. We\'d love to hear from you!')

@section('content')

    <!--==============================
            Breadcumb
            ============================== -->
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('assets/img/bg/breadcumb-bg1-6.jpg') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Contact Us</h1>
            </div>
        </div>
    </div>

    <!--==============================
            Contact Info Area
            ==============================-->
    <div class="contact-info-area space">
        <div class="container">
            <div class="row gy-30 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="contact-info-card text-center p-4">
                        <i class="fas fa-map-marker-alt fa-2x mb-15"></i>
                        <h5>Address</h5>
                        <p>{{ $siteSettings['site_address'] ?? 'Address not set' }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-info-card text-center p-4">
                        <i class="fas fa-phone fa-2x mb-15"></i>
                        <h5>Phone</h5>
                        @if(!empty($siteSettings['site_phone']))
                            <p><a
                                    href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['site_phone']) }}">{{ $siteSettings['site_phone'] }}</a>
                            </p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-info-card text-center p-4">
                        <i class="fas fa-envelope fa-2x mb-15"></i>
                        <h5>Email</h5>
                        @if(!empty($siteSettings['site_email']))
                            <p><a href="mailto:{{ $siteSettings['site_email'] }}">{{ $siteSettings['site_email'] }}</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--==============================
            Contact Form Area
            ==============================-->
    <div class="contact-area-1 space bg-theme">
        <div class="contact-map shape-mockup wow img-custom-anim-left" data-wow-duration="1.5s" data-wow-delay="0.2s"
            data-left="0" data-top="-100px" data-bottom="140px">
            <iframe
                src="{{ $siteSettings['google_map_embed'] ?? 'https://maps.google.com/maps?q=London%20Eye%2C%20London%2C%20United%20Kingdom&t=m&z=10&output=embed&iwloc=near' }}"
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
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control style-border" name="name"
                                            value="{{ old('name') }}" placeholder="Full name*" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control style-border" name="email"
                                            value="{{ old('email') }}" placeholder="Email address*" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control style-border" name="phone"
                                            value="{{ old('phone') }}" placeholder="Phone number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control style-border" name="subject"
                                            value="{{ old('subject') }}" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea name="message" placeholder="How Can We Help You*"
                                            class="form-control style-border" required>{{ old('message') }}</textarea>
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
                @for($i = 0; $i < 4; $i++)
                    <h6 class="item m-item"><a href="#"><i class="fas fa-star-of-life"></i>
                            {{ $siteSettings['marquee_text'] ?? 'We Give Unparalleled Flexibility' }}</a></h6>
                @endfor
            </div>
        </div>
    </div>

@endsection