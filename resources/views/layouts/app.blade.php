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
    <meta name="theme-color" content="#ffffff">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (compiled) -->
    <link rel="stylesheet" href="{{ asset('assets/new-ui/style.css') }}">

    <style>
        :root {
            --theme-color:
                {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
                !important;
            --secondary-color:
                {{ \App\Helpers\ThemeHelper::getFontColor() }}
                !important;
            --secondary-color-light:
                color-mix(in srgb,
                    {{ \App\Helpers\ThemeHelper::getFontColor() }}
                    10%, transparent) !important;
            --body-color:
                {{ \App\Helpers\ThemeHelper::getFontColor() }}
                !important;
            --title-color:
                {{ \App\Helpers\ThemeHelper::getFontColor() }}
                !important;
            --card-bg-color:
                {{ \App\Helpers\ThemeHelper::getCardColor() }}
                !important;
            --border-color:
                {{ \App\Helpers\ThemeHelper::getBorderColor() }}
                !important;
            --footer-bg-color:
                {{ \App\Helpers\ThemeHelper::getFooterColor() }}
                !important;
            --icon-bg-color:
                {{ \App\Helpers\ThemeHelper::getIconBgColor() }}
                !important;
        }

        /* Generic generic utility classes for secondary colors */
        .text-secondary {
            color: var(--secondary-color) !important;
        }

        .bg-secondary {
            background-color: var(--secondary-color) !important;
        }

        .bg-secondary-light {
            background-color: var(--secondary-color-light) !important;
        }

        .border-secondary {
            border-color: var(--secondary-color) !important;
        }

        /* Custom Admin Theme Utilities */
        .bg-card {
            background-color: var(--card-bg-color) !important;
        }

        .bg-footer {
            background-color: var(--footer-bg-color) !important;
        }

        .bg-icon-box {
            background-color: var(--icon-bg-color) !important;
        }

        .border-gray-100,
        .border-slate-100,
        .border-gray-200 {
            border-color: var(--border-color) !important;
        }

        /* Override static secondary colors */
        .text-yellow-500,
        .text-orange-400 {
            color: var(--secondary-color) !important;
        }

        .bg-yellow-500,
        .bg-orange-400 {
            background-color: var(--secondary-color) !important;
        }

        .border-[#xxxxxx],
        .border-yellow-500,
        .border-orange-400 {
            border-color: var(--secondary-color) !important;
        }

        .hover\:bg-yellow-600:hover,
        .hover\:bg-orange-500:hover {
            background-color: var(--secondary-color) !important;
            opacity: 0.9;
        }

        body,
        .bg-\[\#F9F9F7\] {
            background-color:
                {{ \App\Helpers\ThemeHelper::getBackgroundColor() }}
                !important;
            color:
                {{ \App\Helpers\ThemeHelper::getFontColor() }}
                !important;
            font-family: 'Inter', sans-serif !important;
        }

        /* Enforce Neuton font universally override tailwind util classes */
        .font-sans,
        .font-serif,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        span,
        button,
        div,
        li {
            font-family: 'Inter', sans-serif !important;
            letter-spacing: normal !important;
        }

        /* Essential safeguard for ALL screens and ALL typography */
        /* Refined typography safeguards */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            overflow-wrap: break-word;
            word-break: normal;
        }

        p,
        span,
        a,
        div {
            overflow-wrap: break-word;
            word-break: normal;
        }

        /* Increase description text size globally for editor content since Neuton runs small */
        .ckeditor-content p,
        .ckeditor-content span,
        .ckeditor-content li {
            font-size: 1.2rem !important;
            line-height: 1.8 !important;
            letter-spacing: 0.025em !important;
        }

        /* Override Tailwind UI primary colors with dynamic theme color */
        .bg-\[\#4A76B2\],
        .bg-\[\#4E7CC1\] {
            background-color: var(--theme-color) !important;
        }

        .text-\[\#4A76B2\],
        .text-\[\#4E7CC1\] {
            color: var(--theme-color) !important;
        }

        .border-\[\#4A76B2\],
        .border-\[\#4E7CC1\] {
            border-color: var(--theme-color) !important;
        }

        .hover\:bg-\[\#3d66a3\]:hover {
            background-color: var(--theme-color) !important;
            filter: brightness(0.9);
        }

        .hover\:border-\[\#4A76B2\]:hover {
            border-color: var(--theme-color) !important;
        }

        .group:hover .group-hover\:bg-\[\#4A76B2\] {
            background-color: var(--theme-color) !important;
        }

        .group:hover .group-hover\:text-\[\#4E7CC1\] {
            color: var(--theme-color) !important;
        }

        .focus\:ring-\[\#4A76B2\]:focus {
            --tw-ring-color: var(--theme-color) !important;
        }

        ::selection {
            background-color: color-mix(in srgb, var(--theme-color) 30%, transparent) !important;
        }

        /* Seamless Client Marquee */
        .client-marquee {
            width: 100%;
            overflow: hidden;
            position: relative;
            background: white/50;
            padding: 3rem 0;
            border-top: 1px solid #f1f5f9;
            border-bottom: 1px solid #f1f5f9;
        }

        .marquee-track {
            display: flex;
            width: max-content;
            animation: marquee-scroll 12s linear infinite;
        }

        .client-marquee:hover .marquee-track {
            animation-play-state: paused;
        }

        .logo-item {
            flex-shrink: 0;
            width: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            filter: grayscale(100%);
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .logo-item:hover {
            filter: grayscale(0%);
            opacity: 1;
        }

        @keyframes marquee-scroll {
            0% {
                transform: translateX(100vw);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        /* Global Responsive Containers Overrides */
        .container,
        .container-fluid,
        .container-custom {
            max-width: 1440px !important;
            width: 100% !important;
            padding-left: 1.5rem !important;
            padding-right: 1.5rem !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }


    </style>

    @stack('styles')
    {{-- Website JSON-LD Structured Data --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "{{ addslashes($siteSettings['site_name'] ?? 'VMCore') }}",
        "url": "{{ url('/') }}",
        "logo": "{{ asset($siteSettings['logo'] ?? '') }}",
        "description": "{{ addslashes($siteSettings['site_description'] ?? $siteSettings['default_meta_description'] ?? '') }}",
        "contactPoint": {
            "@@type": "ContactPoint",
            "telephone": "{{ $siteSettings['site_phone'] ?? '' }}",
            "email": "{{ $siteSettings['site_email'] ?? '' }}",
            "contactType": "customer service"
        },
        "address": {
            "@@type": "PostalAddress",
            "streetAddress": "{{ addslashes($siteSettings['site_address'] ?? '') }}"
        }
        @if(!empty($siteSettings['social_links']))
            @php
                $socialUrls = is_array($siteSettings['social_links']) ? $siteSettings['social_links'] : json_decode($siteSettings['social_links'], true);
                $sameAs = collect($socialUrls ?? [])->pluck('url')->filter()->values();
            @endphp
            @if($sameAs->count())
                ,"sameAs": {!! $sameAs->toJson() !!}
            @endif
        @endif
    }
    </script>
    @stack('structured_data')

    {{-- Custom Header Code (from Admin > Settings > Global Settings) --}}
        @php $headerCode = setting('header_code'); @endphp
@if(!empty($headerCode))
    {!! $headerCode !!}
@endif
</head>

<body class="font-sans bg-[#F9F9F7] text-slate-900 selection:bg-[#4E7CC1]/30 overflow-x-hidden relative w-full">

    @include('components.navbar')

    <main class="flex-grow" style="padding-top: 110px;">
        @yield('content')
    </main>

    @include('components.footer')

    <!-- Vanilla JS Scroll Animations -->
    <script src="{{ asset('assets/new-ui/script.js') }}"></script>

    @stack('scripts')

    {{-- Custom Footer Code (from Admin > Settings > Global Settings) --}}
        @php $footerCode = setting('footer_code'); @endphp
@if(!empty($footerCode))
    {!! $footerCode !!}
@endif
</body>

</html>