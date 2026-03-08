<!doctype html>
<html class="no-js" lang="en" itemscope itemtype="https://schema.org/WebSite">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', $siteSettings['default_meta_title'] ?? ($siteSettings['site_name'] ?? 'VMCore'))</title>
    <meta name="description" content="@yield('meta_description', $siteSettings['default_meta_description'] ?? '')">
    <meta name="keywords" content="@yield('meta_keywords', $siteSettings['meta_keywords'] ?? '')">
    <meta name="robots" content="INDEX,FOLLOW">
    <meta name="author" content="{{ $siteSettings['site_name'] ?? 'VMCore' }}">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <!-- Open Graph -->
    <meta property="og:title"
        content="@yield('title', $siteSettings['default_meta_title'] ?? ($siteSettings['site_name'] ?? 'VMCore'))">
    <meta property="og:description"
        content="@yield('meta_description', $siteSettings['default_meta_description'] ?? '')">
    <meta property="og:image" content="@yield('og_image', asset($siteSettings['logo'] ?? ''))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:site_name" content="{{ $siteSettings['site_name'] ?? 'VMCore' }}">
    <meta property="og:locale" content="en_US">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title"
        content="@yield('title', $siteSettings['default_meta_title'] ?? ($siteSettings['site_name'] ?? 'VMCore'))">
    <meta name="twitter:description"
        content="@yield('meta_description', $siteSettings['default_meta_description'] ?? '')">
    <meta name="twitter:image" content="@yield('og_image', asset($siteSettings['logo'] ?? ''))">

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

    @if(google_setting('google_verification_enabled') == '1')
        <script
            src="https://www.google.com/recaptcha/api.js?render={{ google_setting('google_recaptcha_site_key') }}"></script>
    @endif

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

        /* ── Mobile hamburger icon — fix colors regardless of theme ── */
        /* On homepage (dark header): white bars */
        .header-layout2 .navbar-right .menu-toggle .line {
            background-color: #fff !important;
        }

        /* On inner pages (light/white header): dark bars */
        .header-layout3 .navbar-right .menu-toggle .line {
            background-color: #1c1c25 !important;
        }

        /* Mobile menu wrapper: always white bg, dark text */
        .mobile-menu-wrapper {
            background-color: rgba(0, 0, 0, 0.6) !important;
        }

        .mobile-menu-wrapper .mobile-menu-area {
            background-color: #fff !important;
            color: #1c1c25 !important;
        }

        .mobile-menu-wrapper .mobile-menu-area a {
            color: #1c1c25 !important;
        }

        .mobile-menu-wrapper .menu-toggle {
            border-color: #1c1c25 !important;
            color: #1c1c25 !important;
        }

        /* Modern Sidebar Styling */
        .custom-sidebar .custom-widget-box {
            background: #ffffff;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--theme-color);
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-sidebar .custom-widget-box:hover {
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
        }

        .custom-sidebar .custom-widget-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--title-color);
            margin-bottom: 24px;
            position: relative;
            padding-bottom: 12px;
            border: none;
        }

        .custom-sidebar .custom-widget-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 3px;
            background: var(--theme-color);
            border-radius: 10px;
        }

        .custom-info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .custom-info-list li {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
        }

        .custom-info-list li:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .custom-info-list li:first-child {
            padding-top: 0;
        }

        .custom-info-list .icon-wrapper {
            flex-shrink: 0;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(0, 0, 0, 0.03);
            color: var(--theme-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            transition: all 0.3s ease;
        }

        .custom-info-list li:hover .icon-wrapper {
            background: var(--theme-color);
            color: #ffffff;
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .custom-info-list .content-wrapper {
            flex-grow: 1;
        }

        .custom-info-list .label {
            display: block;
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            color: var(--body-color);
            opacity: 0.6;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .custom-info-list .value {
            display: block;
            font-size: 1rem;
            font-weight: 600;
            color: var(--title-color);
            word-break: break-all;
        }

        .custom-info-list .btn-live-preview {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--theme-color);
            color: #ffffff !important;
            padding: 10px 24px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            margin-top: 8px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .custom-info-list .btn-live-preview:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            background: #ffffff;
            color: var(--theme-color) !important;
            border-color: var(--theme-color);
        }

        .custom-info-list .btn-live-preview i {
            transition: transform 0.3s ease;
        }

        .custom-info-list .btn-live-preview:hover i {
            transform: translateX(4px);
        }

        .custom-tags-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .custom-tags-wrap a {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background: rgba(0, 0, 0, 0.03);
            color: var(--title-color);
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .custom-tags-wrap a:hover {
            background: var(--theme-color);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Dark theme accommodations */
        body.dark-theme .custom-sidebar .custom-widget-box {
            background: #181824;
            border-color: rgba(255, 255, 255, 0.05);
        }

        body.dark-theme .custom-info-list li {
            border-bottom-color: rgba(255, 255, 255, 0.05);
        }

        body.dark-theme .custom-info-list .icon-wrapper,
        body.dark-theme .custom-tags-wrap a {
            background: rgba(255, 255, 255, 0.05);
        }

        body.dark-theme .custom-tags-wrap a:hover {
            background: var(--theme-color);
        }

        /* Mobile Layout Fixes */
        @media (max-width: 991.98px) {
            .custom-sidebar {
                margin-top: 40px;
            }
        }

        /* ── CKEditor Rich Content Styling ── */
        /* Applied to all CKEditor-rendered content areas on frontend */
        .service-details-content,
        .project-details-content,
        .blog-details-content,
        .team-details-bio,
        .ck-content-rendered {
            font-size: 1rem;
            line-height: 1.85;
            color: var(--body-color);
        }

        .service-details-content h2,
        .project-details-content h2,
        .blog-details-content h2,
        .team-details-bio h2,
        .ck-content-rendered h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: var(--title-color);
            line-height: 1.3;
        }

        .service-details-content h3,
        .project-details-content h3,
        .blog-details-content h3,
        .team-details-bio h3,
        .ck-content-rendered h3 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-top: 1.75rem;
            margin-bottom: 0.85rem;
            color: var(--title-color);
            line-height: 1.35;
        }

        .service-details-content h4,
        .project-details-content h4,
        .blog-details-content h4,
        .team-details-bio h4,
        .ck-content-rendered h4 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            color: var(--title-color);
        }

        .service-details-content h5,
        .project-details-content h5,
        .blog-details-content h5,
        .team-details-bio h5,
        .ck-content-rendered h5 {
            font-size: 1.05rem;
            font-weight: 600;
            margin-top: 1.25rem;
            margin-bottom: 0.6rem;
            color: var(--title-color);
        }

        .service-details-content p,
        .project-details-content p,
        .blog-details-content p,
        .team-details-bio p,
        .ck-content-rendered p {
            margin-bottom: 1.25rem;
            line-height: 1.85;
        }

        .service-details-content ul,
        .service-details-content ol,
        .project-details-content ul,
        .project-details-content ol,
        .blog-details-content ul,
        .blog-details-content ol,
        .team-details-bio ul,
        .team-details-bio ol,
        .ck-content-rendered ul,
        .ck-content-rendered ol {
            padding-left: 1.75rem;
            margin-bottom: 1.25rem;
        }

        .service-details-content li,
        .project-details-content li,
        .blog-details-content li,
        .team-details-bio li,
        .ck-content-rendered li {
            margin-bottom: 0.5rem;
            line-height: 1.7;
        }

        .service-details-content blockquote,
        .project-details-content blockquote,
        .blog-details-content blockquote,
        .team-details-bio blockquote,
        .ck-content-rendered blockquote {
            border-left: 4px solid var(--theme-color);
            padding: 1rem 1.5rem;
            margin: 1.75rem 0;
            background: rgba(0,0,0,0.03);
            border-radius: 0 8px 8px 0;
            font-style: italic;
            color: var(--title-color);
        }

        .service-details-content blockquote p:last-child,
        .project-details-content blockquote p:last-child,
        .blog-details-content blockquote p:last-child,
        .team-details-bio blockquote p:last-child,
        .ck-content-rendered blockquote p:last-child {
            margin-bottom: 0;
        }

        .service-details-content code,
        .project-details-content code,
        .blog-details-content code,
        .team-details-bio code,
        .ck-content-rendered code {
            background: rgba(0,0,0,0.06);
            padding: 0.15em 0.45em;
            border-radius: 4px;
            font-size: 0.88em;
            font-family: 'Courier New', Courier, monospace;
        }

        .service-details-content pre,
        .project-details-content pre,
        .blog-details-content pre,
        .team-details-bio pre,
        .ck-content-rendered pre {
            background: #1c1c25;
            color: #e8e8e8;
            padding: 1.25rem 1.5rem;
            border-radius: 10px;
            overflow-x: auto;
            margin: 1.5rem 0;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .service-details-content pre code,
        .project-details-content pre code,
        .blog-details-content pre code,
        .team-details-bio pre code,
        .ck-content-rendered pre code {
            background: none;
            padding: 0;
            border-radius: 0;
            font-size: inherit;
            color: inherit;
        }

        .service-details-content table,
        .project-details-content table,
        .blog-details-content table,
        .team-details-bio table,
        .ck-content-rendered table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            font-size: 0.95rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border-radius: 10px;
            overflow: hidden;
        }

        .service-details-content table th,
        .project-details-content table th,
        .blog-details-content table th,
        .team-details-bio table th,
        .ck-content-rendered table th {
            background: var(--theme-color);
            color: #fff;
            padding: 0.85rem 1rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .service-details-content table td,
        .project-details-content table td,
        .blog-details-content table td,
        .team-details-bio table td,
        .ck-content-rendered table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid rgba(0,0,0,0.07);
        }

        .service-details-content table tr:last-child td,
        .project-details-content table tr:last-child td,
        .blog-details-content table tr:last-child td,
        .team-details-bio table tr:last-child td,
        .ck-content-rendered table tr:last-child td {
            border-bottom: none;
        }

        .service-details-content table tr:nth-child(even) td,
        .project-details-content table tr:nth-child(even) td,
        .blog-details-content table tr:nth-child(even) td,
        .team-details-bio table tr:nth-child(even) td,
        .ck-content-rendered table tr:nth-child(even) td {
            background: rgba(0,0,0,0.02);
        }

        .service-details-content img,
        .project-details-content img,
        .blog-details-content img,
        .team-details-bio img,
        .ck-content-rendered img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin: 1rem 0;
        }

        .service-details-content a,
        .project-details-content a,
        .blog-details-content a,
        .team-details-bio a,
        .ck-content-rendered a {
            color: var(--theme-color);
            text-decoration: underline;
            text-underline-offset: 3px;
            transition: opacity 0.2s;
        }

        .service-details-content a:hover,
        .project-details-content a:hover,
        .blog-details-content a:hover,
        .team-details-bio a:hover,
        .ck-content-rendered a:hover {
            opacity: 0.75;
        }

        .service-details-content hr,
        .project-details-content hr,
        .blog-details-content hr,
        .team-details-bio hr,
        .ck-content-rendered hr {
            border: none;
            border-top: 1px solid rgba(0,0,0,0.1);
            margin: 2rem 0;
        }

        /* Dark theme adjustments for CKEditor content */
        body.dark-theme .service-details-content blockquote,
        body.dark-theme .project-details-content blockquote,
        body.dark-theme .blog-details-content blockquote,
        body.dark-theme .team-details-bio blockquote,
        body.dark-theme .ck-content-rendered blockquote {
            background: rgba(255,255,255,0.04);
        }

        body.dark-theme .service-details-content code,
        body.dark-theme .project-details-content code,
        body.dark-theme .blog-details-content code,
        body.dark-theme .team-details-bio code,
        body.dark-theme .ck-content-rendered code {
            background: rgba(255,255,255,0.08);
        }

        body.dark-theme .service-details-content table td,
        body.dark-theme .project-details-content table td,
        body.dark-theme .blog-details-content table td,
        body.dark-theme .team-details-bio table td,
        body.dark-theme .ck-content-rendered table td {
            border-bottom-color: rgba(255,255,255,0.07);
        }

        body.dark-theme .service-details-content table tr:nth-child(even) td,
        body.dark-theme .project-details-content table tr:nth-child(even) td,
        body.dark-theme .blog-details-content table tr:nth-child(even) td,
        body.dark-theme .team-details-bio table tr:nth-child(even) td,
        body.dark-theme .ck-content-rendered table tr:nth-child(even) td {
            background: rgba(255,255,255,0.03);
        }

        body.dark-theme .service-details-content hr,
        body.dark-theme .project-details-content hr,
        body.dark-theme .blog-details-content hr,
        body.dark-theme .team-details-bio hr,
        body.dark-theme .ck-content-rendered hr {
            border-top-color: rgba(255,255,255,0.1);
        }
    </style>

    {{-- Website JSON-LD Structured Data --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "{{ addslashes($siteSettings['site_name'] ?? 'VMCore') }}",
        "url": "{{ url('/') }}",
        "logo": "{{ asset($siteSettings['logo'] ?? '') }}",
        "description": "{{ addslashes($siteSettings['site_description'] ?? $siteSettings['default_meta_description'] ?? '') }}",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "{{ $siteSettings['site_phone'] ?? '' }}",
            "email": "{{ $siteSettings['site_email'] ?? '' }}",
            "contactType": "customer service"
        },
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "{{ addslashes($siteSettings['site_address'] ?? '') }}"
        }
    }
    </script>

    @stack('structured_data')

    {{-- Custom Header Code (from Admin > Settings > Global Settings) --}}
    @php $headerCode = setting('header_code'); @endphp
    @if(!empty($headerCode))
        {!! $headerCode !!}
    @endif
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
                        @php
                            $footerLogoUrl = !empty($siteSettings['footer_logo']) ? asset($siteSettings['footer_logo']) : (!empty($siteSettings['logo_white']) ? asset($siteSettings['logo_white']) : asset('assets/img/logo-white.svg'));
                        @endphp
                        <a href="{{ url('/') }}"><img src="{{ $footerLogoUrl }}"
                                alt="{{ $siteSettings['site_name'] ?? 'VMCore' }}"
                                style="height: 45px; width: auto; object-fit: contain;"></a>
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
                @php
                    $mobileLogoUrl = !empty($siteSettings['logo']) ? asset($siteSettings['logo']) : asset('assets/img/logo.svg');
                @endphp
                <a href="{{ url('/') }}"><img src="{{ $mobileLogoUrl }}"
                        alt="{{ $siteSettings['site_name'] ?? 'VMCore' }}"
                        style="height: 45px; width: auto; object-fit: contain;"></a>
            </div>
            <div class="mobile-menu">
                <ul>
                    @if(isset($headerMenu) && $headerMenu->count() > 0)
                        @foreach($headerMenu as $item)
                            <x-menu-item :item="$item" :isMobile="true" />
                        @endforeach
                    @else
                        <li class="active"><a href="{{ url('/') }}">Home</a></li>
                        @if(\App\Models\Setting::get('show_about_page', 1))
                            <li><a href="{{ route('about') }}">About</a></li>
                        @endif
                        @if(\App\Models\Setting::get('show_services_page', 1))
                            <li><a href="{{ route('services') }}">Services</a></li>
                        @endif
                        @if(\App\Models\Setting::get('show_portfolio_page', 1))
                            <li><a href="{{ route('portfolio') }}">Portfolio</a></li>
                        @endif
                        @if(\App\Models\Setting::get('show_blog_page', 1))
                            <li><a href="{{ route('blog') }}">Blog</a></li>
                        @endif
                        @if(\App\Models\Setting::get('show_team_page', 1))
                            <li><a href="{{ route('team') }}">Team</a></li>
                        @endif
                        @if(\App\Models\Setting::get('show_faq_page', 1))
                            <li><a href="{{ route('faq') }}">FAQ</a></li>
                        @endif
                        @if(\App\Models\Setting::get('show_contact_page', 1))
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        @endif
                    @endif
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

    {{-- Custom Footer Code (from Admin > Settings > Global Settings) --}}
    @php $footerCode = setting('footer_code'); @endphp
    @if(!empty($footerCode))
        {!! $footerCode !!}
    @endif
</body>

</html>