@extends('layouts.app')

@section('title', 'Portfolio - VMCore')
@section('meta_description', 'Explore our portfolio of successful projects at VMCore.')

@section('content')
<!--==============================
    Breadcumb
    ============================== -->
    <div class="breadcumb-wrapper " data-bg-src="{{ asset('assets/img/bg/breadcumb-bg1-7.jpg') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Portfolio</h1>
            </div>
        </div>
    </div>

    <!--==============================
        Portfolio Area
    ==============================-->
    <div class="portfolio-area-1 space overflow-hidden">
        <div class="container">
            <div class="row justify-content-between masonary-active">
                <div class="col-lg-6 filter-item">
                    <div class="portfolio-wrap mt-lg-140">
                        <div class="portfolio-thumb ">
                            <a href="{{ url('/portfolio-details') }}">
                                <img src="{{ asset('assets/img/portfolio/portfolio1_1.jpg') }}" alt="portfolio">
                            </a>
                        </div>
                        <div class="portfolio-details">
                            <ul class="portfolio-meta">
                                <li><a href="{{ url('/blog') }}">Branding</a></li>
                                <li><a href="{{ url('/blog') }}">Development</a></li>
                                <li><a href="{{ url('/blog') }}">Marketing</a></li>
                            </ul>
                            <h3 class="portfolio-title"><a href="{{ url('/portfolio-details') }}">Money Laundering Compliance Scanner</a></h3>
                            <a href="{{ url('/portfolio-details') }}" class="link-btn">
                                <span class="link-effect">
                                    <span class="effect-1">VIEW PROJECT</span>
                                    <span class="effect-1">VIEW PROJECT</span>
                                </span>
                                <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 filter-item">
                    <div class="portfolio-wrap mt-140 mt-lg-0">
                        <div class="portfolio-thumb ">
                            <a href="{{ url('/portfolio-details') }}">
                                <img src="{{ asset('assets/img/portfolio/portfolio1_2.jpg') }}" alt="portfolio">
                            </a>
                        </div>
                        <div class="portfolio-details">
                            <ul class="portfolio-meta">
                                <li><a href="{{ url('/blog') }}">Branding</a></li>
                                <li><a href="{{ url('/blog') }}">Development</a></li>
                                <li><a href="{{ url('/blog') }}">Marketing</a></li>
                            </ul>
                            <h3 class="portfolio-title"><a href="{{ url('/portfolio-details') }}">Decentralized Lending Platform for Students</a></h3>
                            <a href="{{ url('/portfolio-details') }}" class="link-btn">
                                <span class="link-effect">
                                    <span class="effect-1">VIEW PROJECT</span>
                                    <span class="effect-1">VIEW PROJECT</span>
                                </span>
                                <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 filter-item">
                    <div class="portfolio-wrap mt-140">
                        <div class="portfolio-thumb ">
                            <a href="{{ url('/portfolio-details') }}">
                                <img src="{{ asset('assets/img/portfolio/portfolio1_3.jpg') }}" alt="portfolio">
                            </a>
                        </div>
                        <div class="portfolio-details">
                            <ul class="portfolio-meta">
                                <li><a href="{{ url('/blog') }}">Branding</a></li>
                                <li><a href="{{ url('/blog') }}">Development</a></li>
                                <li><a href="{{ url('/blog') }}">Marketing</a></li>
                            </ul>
                            <h3 class="portfolio-title"><a href="{{ url('/portfolio-details') }}">Anti Money Laundering Compliance Scanner</a></h3>
                            <a href="{{ url('/portfolio-details') }}" class="link-btn">
                                <span class="link-effect">
                                    <span class="effect-1">VIEW PROJECT</span>
                                    <span class="effect-1">VIEW PROJECT</span>
                                </span>
                                <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 filter-item">
                    <div class="portfolio-wrap mt-140">
                        <div class="portfolio-thumb ">
                            <a href="{{ url('/portfolio-details') }}">
                                <img src="{{ asset('assets/img/portfolio/portfolio1_4.jpg') }}" alt="portfolio">
                            </a>
                        </div>
                        <div class="portfolio-details">
                            <ul class="portfolio-meta">
                                <li><a href="{{ url('/blog') }}">Branding</a></li>
                                <li><a href="{{ url('/blog') }}">Development</a></li>
                                <li><a href="{{ url('/blog') }}">Marketing</a></li>
                            </ul>
                            <h3 class="portfolio-title"><a href="{{ url('/portfolio-details') }}">Shopify Redesign for a Nova Scotia Winery</a></h3>
                            <a href="{{ url('/portfolio-details') }}" class="link-btn">
                                <span class="link-effect">
                                    <span class="effect-1">VIEW PROJECT</span>
                                    <span class="effect-1">VIEW PROJECT</span>
                                </span>
                                <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 filter-item">
                    <div class="portfolio-wrap mt-140">
                        <div class="portfolio-thumb ">
                            <a href="{{ url('/portfolio-details') }}">
                                <img src="{{ asset('assets/img/portfolio/portfolio1_5.png') }}" alt="portfolio">
                            </a>
                        </div>
                        <div class="portfolio-details">
                            <ul class="portfolio-meta">
                                <li><a href="{{ url('/blog') }}">Branding</a></li>
                                <li><a href="{{ url('/blog') }}">Development</a></li>
                                <li><a href="{{ url('/blog') }}">Marketing</a></li>
                            </ul>
                            <h3 class="portfolio-title"><a href="{{ url('/portfolio-details') }}">Product Lineup Industrial <br> Design for Caramba</a></h3>
                            <a href="{{ url('/portfolio-details') }}" class="link-btn">
                                <span class="link-effect">
                                    <span class="effect-1">VIEW PROJECT</span>
                                    <span class="effect-1">VIEW PROJECT</span>
                                </span>
                                <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 filter-item">
                    <div class="portfolio-wrap mt-140">
                        <div class="portfolio-thumb">
                            <a href="{{ url('/portfolio-details') }}">
                                <img src="{{ asset('assets/img/portfolio/portfolio1_6.png') }}" alt="portfolio">
                            </a>
                        </div>
                        <div class="portfolio-details">
                            <ul class="portfolio-meta">
                                <li><a href="{{ url('/blog') }}">Branding</a></li>
                                <li><a href="{{ url('/blog') }}">Development</a></li>
                                <li><a href="{{ url('/blog') }}">Marketing</a></li>
                            </ul>
                            <h3 class="portfolio-title"><a href="{{ url('/portfolio-details') }}">Trading Website Design & Development</a></h3>
                            <a href="{{ url('/portfolio-details') }}" class="link-btn">
                                <span class="link-effect">
                                    <span class="effect-1">VIEW PROJECT</span>
                                    <span class="effect-1">VIEW PROJECT</span>
                                </span>
                                <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-wrap justify-content-center mt-60">
                <a class="btn" href="{{ url('/portfolio') }}">
                    <span class="link-effect">
                        <span class="effect-1">LOAD MORE</span>
                        <span class="effect-1">LOAD MORE</span>
                    </span>
                </a>
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
