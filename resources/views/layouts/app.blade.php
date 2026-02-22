<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', $siteSettings['meta_title'] ?? 'VMCore - Creative Digital Agency')</title>
    <meta name="description"
        content="@yield('meta_description', $siteSettings['meta_description'] ?? 'VMCore - Creative Digital Agency & Technology Solutions')">
    <meta name="keywords"
        content="@yield('meta_keywords', $siteSettings['meta_keywords'] ?? 'VMCore, Digital Agency, Web Development, Technology')">
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', $siteSettings['meta_title'] ?? 'VMCore')">
    <meta property="og:description" content="@yield('meta_description', $siteSettings['meta_description'] ?? '')">
    <meta property="og:image" content="@yield('og_image', asset($siteSettings['og_image'] ?? 'assets/img/logo.svg'))">
    <meta property="og:type" content="website">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset($siteSettings['favicon'] ?? 'assets/img/favicons/favicon.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Unbounded:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- All CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/imageRevealHover.css') }}">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @stack('styles')

    <style>
        :root {
            --theme-color:
                {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
                !important;
            --body-color:
                {{ \App\Helpers\ThemeHelper::getFontColor() }}
                !important;
            --title-color:
                {{ \App\Helpers\ThemeHelper::getFontColor() }}
                !important;
        }

        body {
            background-color:
                {{ \App\Helpers\ThemeHelper::getBackgroundColor() }}
                !important;
            color:
                {{ \App\Helpers\ThemeHelper::getFontColor() }}
                !important;
        }

        .text-sky-500 {
            color:
                {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
                !important;
        }

        .bg-sky-500 {
            background-color:
                {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
                !important;
        }

        .border-sky-500 {
            border-color:
                {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
                !important;
        }

        /* Override Tailwind bg-white/black if they conflict with user choice, though usually we want specific components to stay white/black */
    </style>
</head>

<body>

    <!--==============================
     Preloader
    ==============================-->
    <div class="preloader">
        <div class="preloader-inner">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="popup-search-box">
        <button class="searchClose"><img src="{{ asset('assets/img/icon/close.svg') }}" alt="img"></button>
        <form action="#">
            <input type="text" placeholder="Search Here..">
            <button type="submit"><img src="{{ asset('assets/img/icon/search-white.svg') }}" alt="img"></button>
        </form>
    </div>

    <div class="sidemenu-wrapper">
        <div class="sidemenu-content">
            <button class="closeButton sideMenuCls"><img src="{{ asset('assets/img/icon/close.svg') }}"
                    alt="icon"></button>
            <div class="widget footer-widget">
                <div class="widget-about">
                    <div class="footer-logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo-white.svg') }}" alt="VMCore"></a>
                    </div>
                    <p class="about-text">
                        {{ $siteSettings['site_description'] ?? 'We are digital agency that helps businesses develop immersive and engaging' }}
                    </p>
                    <div class="sidebar-wrap">
                        <h6>{{ $siteSettings['site_address'] ?? '' }}</h6>
                    </div>
                    <div class="sidebar-wrap">
                        @if(!empty($siteSettings['site_phone']))
                            <h6><a
                                    href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['site_phone']) }}">{{ $siteSettings['site_phone'] }}</a>
                        </h6>@endif
                        @if(!empty($siteSettings['site_email']))
                            <h6><a href="mailto:{{ $siteSettings['site_email'] }}">{{ $siteSettings['site_email'] }}</a>
                        </h6>@endif
                    </div>
                    <div class="social-btn style2">
                        @foreach(($socialLinks ?? []) as $link)
                            <a href="{{ $link->url }}" target="_blank">
                                <span class="link-effect">
                                    <span class="effect-1"><i class="{{ $link->icon_class }}"></i></span>
                                    <span class="effect-1"><i class="{{ $link->icon_class }}"></i></span>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ url('/contact') }}" class="chat-btn gsap-magnetic">Let's Talk with us</a>
            </div>
        </div>
    </div>

    <!--==============================
    Mobile Menu
    ============================== -->
    <div class="mobile-menu-wrapper">
        <div class="mobile-menu-area">
            <button class="menu-toggle"><i class="fas fa-times"></i></button>
            <div class="mobile-logo">
                <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo.svg') }}" alt="VMCore"></a>
            </div>
            <div class="mobile-menu">
                <ul>
                    <li>
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ url('/about') }}">About</a>
                    </li>
                    <li>
                        <a href="{{ url('/services') }}">Services</a>
                    </li>
                    <li>
                        <a href="{{ url('/portfolio') }}">Portfolio</a>
                    </li>
                    <li>
                        <a href="{{ url('/blog') }}">Blog</a>
                    </li>
                    <li>
                        <a href="{{ url('/contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-wrap">
                <h6>{{ $siteSettings['site_address'] ?? '' }}</h6>
            </div>
            <div class="sidebar-wrap">
                @if(!empty($siteSettings['site_phone']))
                    <h6><a
                            href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['site_phone']) }}">{{ $siteSettings['site_phone'] }}</a>
                </h6>@endif
                @if(!empty($siteSettings['site_email']))
                <h6><a href="mailto:{{ $siteSettings['site_email'] }}">{{ $siteSettings['site_email'] }}</a></h6>@endif
            </div>
            <div class="social-btn style3">
                @foreach(($socialLinks ?? []) as $link)
                    <a href="{{ $link->url }}" target="_blank">
                        <span class="link-effect">
                            <span class="effect-1"><i class="{{ $link->icon_class }}"></i></span>
                            <span class="effect-1"><i class="{{ $link->icon_class }}"></i></span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    <!-- Scroll To Top -->
    <div class="scroll-top">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
            </path>
        </svg>
    </div>

    <!-- Jquery -->
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('assets/js/twinmax.js') }}"></script>
    <script src="{{ asset('assets/js/imageRevealHover.js') }}"></script>
    <script src="{{ asset('assets/js/jarallax.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.marquee.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>

    <!-- Main Js File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>