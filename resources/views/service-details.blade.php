@extends('layouts.app')

@section('title', ($service->meta_title ?? $service->title) . ' - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', $service->meta_description ?? $service->short_description ?? '')
@section('meta_keywords', $service->tags->count() ? $service->tags->pluck('title')->implode(', ') : '')
@section('canonical', route('service.detail', $service->slug))
@if($service->meta_robots)
    @section('robots', $service->meta_robots)
@endif

@push('styles')
    <style>
        /* ══════════════════════════════════════════════════
           SERVICE DETAILS — MODERN PROFESSIONAL REDESIGN
           ══════════════════════════════════════════════════ */

        /* ── HERO ── */
        .sd-hero {
            position: relative;
            padding: 3.5rem 0 2rem;
            overflow: hidden;
            text-align: center;
        }

        .sd-hero::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, color-mix(in srgb, var(--theme-color, #c5a059) 6%, transparent) 1px, transparent 1px);
            background-size: 18px 18px;
            opacity: 0.7;
            pointer-events: none;
        }

        .sd-breadcrumb {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: var(--body-color, #888);
            margin-bottom: 1.25rem;
        }

        .sd-breadcrumb a {
            color: var(--body-color, #888);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .sd-breadcrumb a:hover {
            color: var(--theme-color, #c5a059);
        }

        .sd-breadcrumb .sd-bc-sep {
            opacity: 0.4;
        }

        .sd-breadcrumb .sd-bc-current {
            color: var(--title-color, #1a1a1a);
            font-weight: 600;
        }

        .sd-hero-title {
            font-size: clamp(2.5rem, 5vw, 3.75rem);
            font-weight: 700;
            color: var(--title-color, #1a1a1a);
            line-height: 1.15;
            margin-bottom: 1rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .sd-hero-subtitle {
            color: var(--body-color, #666);
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            font-size: 1.05rem;
            line-height: 1.7;
        }

        /* ── BANNER IMAGE ── */
        .sd-banner {
            position: relative;
            border-radius: 1rem;
            overflow: hidden;
            margin-bottom: 3rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        }

        .sd-banner img {
            width: 100%;
            height: 380px;
            object-fit: cover;
            display: block;
            transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .sd-banner:hover img {
            transform: scale(1.03);
        }

        .sd-banner::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 80px;
            background: linear-gradient(to top, rgba(0,0,0,0.18), transparent);
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .sd-banner img {
                height: 240px;
            }
        }

        /* ── LAYOUT GRID ── */
        .sd-layout-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 3rem;
            align-items: start;
        }

        @media (min-width: 1024px) {
            .sd-layout-grid {
                grid-template-columns: 1fr 340px;
                gap: 4rem;
            }
        }

        /* ── DESCRIPTION ── */
        .sd-description .ckeditor-content {
            font-size: 1.05rem;
            line-height: 1.9;
            color: var(--body-color, #444);
        }

        /* ── SIDEBAR ── */
        .sd-sidebar {
            position: sticky;
            top: 6rem;
        }

        .sd-widget {
            background: var(--card-bg-color, #ffffff);
            border: 1px solid color-mix(in srgb, var(--theme-color, #c5a059) 12%, transparent);
            border-radius: 0.875rem;
            padding: 1.75rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 8px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .sd-widget:hover {
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
        }

        .sd-widget-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 1.15rem;
            padding-bottom: 0.85rem;
            border-bottom: 1px solid color-mix(in srgb, var(--theme-color, #c5a059) 12%, transparent);
            color: var(--title-color, #1a1a1a);
        }

        .sd-menu-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.7rem 0.85rem;
            margin: 0.2rem 0;
            color: var(--body-color, #555);
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            font-size: 0.92rem;
            font-weight: 500;
        }

        .sd-menu-link:hover,
        .sd-menu-link.active {
            background: color-mix(in srgb, var(--theme-color, #c5a059) 8%, transparent);
            color: var(--theme-color, #c5a059);
        }

        .sd-menu-link.active {
            font-weight: 700;
        }

        .sd-menu-link .sd-link-arrow {
            opacity: 0;
            transform: translateX(-4px);
            transition: all 0.2s ease;
        }

        .sd-menu-link:hover .sd-link-arrow,
        .sd-menu-link.active .sd-link-arrow {
            opacity: 1;
            transform: translateX(0);
        }

        .sd-contact-row {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.65rem 0;
            color: var(--body-color, #555);
        }

        .sd-contact-icon {
            width: 36px;
            height: 36px;
            border-radius: 0.5rem;
            background: color-mix(in srgb, var(--theme-color, #c5a059) 8%, transparent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--theme-color, #c5a059);
            flex-shrink: 0;
        }

        .sd-contact-row a {
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--title-color, #1a1a1a);
            transition: color 0.2s ease;
        }

        .sd-contact-row a:hover {
            color: var(--theme-color, #c5a059);
        }

        .sd-tag {
            display: inline-block;
            background: color-mix(in srgb, var(--theme-color, #c5a059) 8%, transparent);
            color: var(--theme-color, #c5a059);
            padding: 0.35rem 0.85rem;
            border-radius: 0.5rem;
            font-size: 0.8rem;
            font-weight: 600;
            margin: 0 0.4rem 0.5rem 0;
            transition: all 0.2s ease;
        }

        .sd-tag:hover {
            background: var(--theme-color, #c5a059);
            color: #ffffff;
        }

        /* ── RELATED PROJECTS ── */
        .sd-projects-section {
            margin-top: 3.5rem;
            padding-top: 2.5rem;
            border-top: 1px solid color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent);
        }

        .sd-section-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.75rem;
        }

        .sd-section-header .sd-accent-bar {
            width: 4px;
            height: 24px;
            border-radius: 4px;
            background: var(--theme-color, #c5a059);
            flex-shrink: 0;
        }

        .sd-section-header h3 {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--title-color, #1a1a1a);
            margin: 0;
        }

        .pd-rel-card {
            display: block;
            text-decoration: none;
            border-radius: 0.875rem;
            overflow: hidden;
            background: var(--card-bg-color, #fff);
            border: 1px solid color-mix(in srgb, var(--theme-color, #c5a059) 8%, transparent);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            transition: all 0.35s ease;
        }

        .pd-rel-card:hover {
            border-color: var(--theme-color, #c5a059);
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.08);
            transform: translateY(-4px);
        }

        .pd-rel-img-wrap {
            position: relative;
            overflow: hidden;
            aspect-ratio: 16 / 10;
            background: #f1f1f1;
        }

        .pd-rel-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .pd-rel-card:hover .pd-rel-img-wrap img {
            transform: scale(1.06);
        }

        .pd-rel-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 50%, rgba(15, 23, 42, 0.5) 100%);
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
            padding: 0.85rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .pd-rel-card:hover .pd-rel-overlay {
            opacity: 1;
        }

        .pd-rel-btn {
            background: #fff;
            color: #0f172a;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.12);
            transform: translateY(6px);
            transition: transform 0.3s ease;
        }

        .pd-rel-card:hover .pd-rel-btn {
            transform: translateY(0);
        }

        .pd-rel-info {
            padding: 1rem 1.15rem 1.15rem;
        }

        .pd-rel-category {
            display: inline-block;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--theme-color, #c5a059);
            margin-bottom: 0.35rem;
        }

        .pd-rel-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--title-color, #1a1a1a);
            line-height: 1.35;
            transition: color 0.2s ease;
        }

        .pd-rel-card:hover .pd-rel-title {
            color: var(--theme-color, #c5a059);
        }

        /* ── PROCESS SECTION ── */
        .sd-process {
            padding: 5rem 0 4rem;
            margin-top: 2rem;
            position: relative;
        }

        .sd-process::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, color-mix(in srgb, var(--theme-color, #c5a059) 15%, transparent), transparent);
        }

        .sd-process-header {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .sd-process-label {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--theme-color, #c5a059);
            background: color-mix(in srgb, var(--theme-color, #c5a059) 8%, transparent);
            padding: 0.4rem 1rem;
            border-radius: 2rem;
            margin-bottom: 1rem;
        }

        .sd-process-title {
            font-size: clamp(1.75rem, 3vw, 2.5rem);
            font-weight: 700;
            color: var(--title-color, #1a1a1a);
            line-height: 1.2;
        }

        .sd-process-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0;
            position: relative;
        }

        @media (max-width: 768px) {
            .sd-process-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        .sd-step {
            position: relative;
            padding: 2rem 1.75rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        @media (min-width: 769px) {
            .sd-step:not(:last-child)::after {
                content: '';
                position: absolute;
                right: 0;
                top: 50%;
                transform: translateY(-50%);
                width: 1px;
                height: 60%;
                background: color-mix(in srgb, var(--theme-color, #c5a059) 12%, transparent);
            }
        }

        .sd-step:hover {
            background: color-mix(in srgb, var(--theme-color, #c5a059) 3%, transparent);
            border-radius: 0.75rem;
        }

        .sd-step-num {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            color: var(--theme-color, #c5a059);
            margin-bottom: 1rem;
            text-transform: uppercase;
        }

        .sd-step-icon {
            width: 52px;
            height: 52px;
            border-radius: 0.75rem;
            background: color-mix(in srgb, var(--theme-color, #c5a059) 8%, transparent);
            color: var(--theme-color, #c5a059);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            transition: all 0.3s ease;
        }

        .sd-step:hover .sd-step-icon {
            background: var(--theme-color, #c5a059);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px color-mix(in srgb, var(--theme-color, #c5a059) 25%, transparent);
        }

        .sd-step h4 {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--title-color, #1a1a1a);
            margin-bottom: 0.5rem;
        }

        .sd-step p {
            font-size: 0.85rem;
            color: var(--body-color, #777);
            line-height: 1.6;
            max-width: 240px;
            margin: 0 auto;
        }
    </style>
@endpush

@push('structured_data')
    <script type="application/ld+json">
                                    {
                                        "@@context": "https://schema.org",
                                        "@@type": "Service",
                                        "name": "{{ addslashes($service->title) }}",
                                        "description": "{{ addslashes($service->meta_description ?? $service->short_description ?? '') }}",
                                        "provider": {
                                            "@@type": "Organization",
                                            "name": "{{ addslashes($siteSettings['site_name'] ?? 'VMCore') }}",
                                            "url": "{{ url('/') }}"
                                        },
                                        "url": "{{ route('service.detail', $service->slug) }}"
                                    }
                                </script>
    {!! $service->faq_schema_script !!}
@endpush

@section('content')

    {{-- HERO SECTION --}}
    <section class="sd-hero container-custom">
        {{-- <nav class="sd-breadcrumb animate-on-scroll">
            <a href="{{ url('/') }}">Home</a>
            <span class="sd-bc-sep">/</span>
            <a href="{{ route('services') }}">Services</a>
            <span class="sd-bc-sep">/</span>
            <span class="sd-bc-current">{{ $service->title }}</span>
        </nav> --}}
        <h1 class="sd-hero-title animate-on-scroll" style="font-family: 'Neuton', serif;">{{ $service->title }}</h1>
        @if($service->short_description)
            <p class="sd-hero-subtitle animate-on-scroll delay-100">{{ $service->short_description }}</p>
        @endif
    </section>

    {{-- FULL-WIDTH BANNER --}}
    @if($service->image || $service->banner_image)
        <div class="container-custom animate-on-scroll delay-100">
            <div class="sd-banner">
                <img src="{{ asset($service->image ?? $service->banner_image) }}" alt="{{ $service->title }}">
            </div>
        </div>
    @endif

    {{-- CONTENT GRID --}}
    <section class="container-custom pb-20">
        <div class="sd-layout-grid">

            {{-- Left Content --}}
            <div class="delay-100">
                {{-- Service Description --}}
                @if($service->description)
                    <div class="sd-description">
                        <div class="ckeditor-content">
                            {!! $service->description !!}
                        </div>
                    </div>
                @endif

                {{-- Related Projects --}}
                @if($service->projects->count())
                    <div class="sd-projects-section">
                        <div class="sd-section-header">
                            <span class="sd-accent-bar"></span>
                            <h3>{!! setting('service_related_projects_title', 'Related Projects') !!}</h3>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($service->projects->take(4) as $project)
                                <a href="{{ route('portfolio.detail', $project->slug) }}" class="group pd-rel-card">
                                    <div class="pd-rel-img-wrap">
                                        <img src="{{ $project->image ? asset($project->image) : asset('assets/img/portfolio/portfolio2_1.jpg') }}"
                                            alt="{{ $project->title }}" />
                                        <div class="pd-rel-overlay">
                                            <span class="pd-rel-btn">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7"/><path d="M7 7h10v10"/></svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="pd-rel-info">
                                        <span class="pd-rel-category">{{ $project->categories->first()->name ?? 'Portfolio' }}</span>
                                        <h4 class="pd-rel-title">{{ $project->title }}</h4>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Right Sidebar --}}
            <div class="sd-sidebar animate-on-scroll delay-300">

                {{-- Other Services Widget --}}
                @if(isset($relatedServices) && $relatedServices->count())
                    <div class="sd-widget">
                        <h4 class="sd-widget-title">{!! setting('sidebar_services_title', 'All Services') !!}</h4>
                        <div class="flex flex-col">
                            @foreach($relatedServices as $related)
                                <a href="{{ route('service.detail', $related->slug) }}"
                                    class="sd-menu-link {{ $service->id == $related->id ? 'active' : '' }}">
                                    <span>{{ $related->title }}</span>
                                    <span class="sd-link-arrow">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Contact/Help Widget --}}
                <div class="sd-widget">
                    <h4 class="sd-widget-title">{!! setting('sidebar_help_title', 'Need Help?') !!}</h4>
                    <div>
                        @if(!empty($siteSettings['site_phone']))
                            <div class="sd-contact-row">
                                <span class="sd-contact-icon">
                                    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                    </svg>
                                </span>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['site_phone']) }}">{{ $siteSettings['site_phone'] }}</a>
                            </div>
                        @endif
                        @if(!empty($siteSettings['site_email']))
                            <div class="sd-contact-row">
                                <span class="sd-contact-icon">
                                    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <rect width="20" height="16" x="2" y="4" rx="2" />
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                    </svg>
                                </span>
                                <a href="mailto:{{ $siteSettings['site_email'] }}">{{ $siteSettings['site_email'] }}</a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Tags Widget --}}
                @if($service->tags && $service->tags->count())
                    <div class="sd-widget">
                        <h4 class="sd-widget-title">{!! setting('service_tags_title', 'Tags') !!}</h4>
                        <div class="flex flex-wrap">
                            @foreach($service->tags as $tag)
                                <span class="sd-tag">#{{ $tag->title }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>

    {{-- PROCESS SECTION --}}
    <section class="sd-process container-custom">
        <div class="sd-process-header animate-on-scroll">
            <span class="sd-process-label">{!! setting('process_section_label', 'How We Work') !!}</span>
            <h2 class="sd-process-title">{!! setting('process_section_heading', 'Our Process') !!}</h2>
        </div>

        <div class="sd-process-grid">

            {{-- Step 1 --}}
            <div class="sd-step animate-on-scroll">
                <div class="sd-step-num">Step 01</div>
                <div class="sd-step-icon">
                    <svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8" /><path d="m21 21-4.3-4.3" />
                    </svg>
                </div>
                <h4>{!! setting('process_step_1_title', 'Discovery') !!}</h4>
                <p>{!! setting('process_step_1_description', 'Understanding your goals, audience, and challenges.') !!}</p>
            </div>

            {{-- Step 2 --}}
            <div class="sd-step animate-on-scroll delay-100">
                <div class="sd-step-num">Step 02</div>
                <div class="sd-step-icon">
                    <svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21.21 15.89A10 10 0 1 1 8 2.83" /><path d="M22 12A10 10 0 0 0 12 2v10z" />
                    </svg>
                </div>
                <h4>{!! setting('process_step_2_title', 'Strategy') !!}</h4>
                <p>{!! setting('process_step_2_description', 'Crafting a data-driven roadmap aligned with your objectives.') !!}</p>
            </div>

            {{-- Step 3 --}}
            <div class="sd-step animate-on-scroll delay-200">
                <div class="sd-step-num">Step 03</div>
                <div class="sd-step-icon">
                    <svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="13.5" cy="6.5" r=".5" fill="currentColor" /><circle cx="17.5" cy="10.5" r=".5" fill="currentColor" /><circle cx="8.5" cy="7.5" r=".5" fill="currentColor" /><circle cx="6.5" cy="12.5" r=".5" fill="currentColor" />
                        <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z" />
                    </svg>
                </div>
                <h4>{!! setting('process_step_3_title', 'Design') !!}</h4>
                <p>{!! setting('process_step_3_description', 'Creating intuitive interfaces that engage and elevate.') !!}</p>
            </div>

            {{-- Step 4 --}}
            <div class="sd-step animate-on-scroll delay-300">
                <div class="sd-step-num">Step 04</div>
                <div class="sd-step-icon">
                    <svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="16 18 22 12 16 6" /><polyline points="8 6 2 12 8 18" />
                    </svg>
                </div>
                <h4>{!! setting('process_step_4_title', 'Development') !!}</h4>
                <p>{!! setting('process_step_4_description', 'Building high-performance systems with clean code.') !!}</p>
            </div>

            {{-- Step 5 --}}
            <div class="sd-step animate-on-scroll delay-[350ms]">
                <div class="sd-step-num">Step 05</div>
                <div class="sd-step-icon">
                    <svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" /><path d="m9 12 2 2 4-4" />
                    </svg>
                </div>
                <h4>{!! setting('process_step_5_title', 'QA & Testing') !!}</h4>
                <p>{!! setting('process_step_5_description', 'Rigorous testing to ensure flawless performance and security.') !!}</p>
            </div>

            {{-- Step 6 --}}
            <div class="sd-step animate-on-scroll delay-400">
                <div class="sd-step-num">Step 06</div>
                <div class="sd-step-icon">
                    <svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z" />
                        <path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z" />
                        <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0" />
                        <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5" />
                    </svg>
                </div>
                <h4>{!! setting('process_step_6_title', 'Launch') !!}</h4>
                <p>{!! setting('process_step_6_description', 'Deploying with precision and monitoring performance.') !!}</p>
            </div>

        </div>
    </section>

@endsection