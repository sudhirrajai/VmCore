@extends('layouts.app')

@section('title', ($service->meta_title ?? $service->title) . ' - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', $service->meta_description ?? $service->short_description ?? '')
@section('meta_keywords', $service->tags->count() ? $service->tags->pluck('title')->implode(', ') : '')
@section('canonical', route('service.detail', $service->slug))

@push('styles')
    <style>
        /* Modern Theme Specific Overrides for Service Details */
        .sd-hero {
            padding: 4rem 0 3rem;
            text-align: center;
        }

        .sd-hero-title {
            font-size: clamp(3rem, 6vw, 4.5rem);
            font-weight: 700;
            color: var(--title-color, #1a1a1a);
            line-height: 1.1;
            margin-bottom: 1rem;
        }

        .sd-hero-subtitle {
            font-size: clamp(1.1rem, 2vw, 1.35rem);
            color: var(--theme-color, #c5a059);
            max-width: 600px;
            margin: 0 auto;
        }

        .sd-layout-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 4rem;
            align-items: start;
        }

        @media (min-width: 1024px) {
            .sd-layout-grid {
                grid-template-columns: 2fr 1fr;
                gap: 5rem;
            }
        }

        /* Sidebar styles */
        .sd-sidebar {
            position: sticky;
            top: 7rem;
            padding-bottom: 3rem;
        }

        .sd-widget {
            background: var(--card-bg-color, #ffffff);
            border: 1px solid color-mix(in srgb, var(--theme-color, #c5a059) 15%, transparent);
            border-radius: 1rem;
            padding: 2.5rem 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
        }

        .sd-widget:hover {
            border-color: var(--theme-color, #c5a059);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
            transform: translateY(-2px);
        }

        .sd-widget-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid color-mix(in srgb, var(--theme-color, #c5a059) 15%, transparent);
            color: var(--title-color, #1a1a1a);
        }

        .sd-menu-link {
            display: block;
            padding: 0.85rem 0;
            color: var(--body-color, #666666);
            border-bottom: 1px solid color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent);
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .sd-menu-link:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .sd-menu-link:hover,
        .sd-menu-link.active {
            color: var(--theme-color, #c5a059);
            transform: translateX(4px);
        }

        .sd-contact-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            color: var(--body-color, #666666);
        }

        .sd-contact-row a {
            transition: color 0.2s ease;
        }

        .sd-contact-row a:hover {
            color: var(--theme-color, #c5a059);
        }

        .sd-tag {
            display: inline-block;
            background: color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent);
            color: var(--theme-color, #c5a059);
            padding: 0.4rem 1rem;
            border-radius: 2rem;
            font-size: 0.85rem;
            font-weight: 600;
            margin: 0 0.5rem 0.5rem 0;
            transition: all 0.2s ease;
        }

        .sd-tag:hover {
            background: var(--theme-color, #c5a059);
            color: #ffffff;
        }

        /* ── RELATED PROJECTS ── */
        .pd-rel-card {
            display: block;
            text-decoration: none;
            cursor: pointer;
        }

        .pd-rel-img-wrap {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            aspect-ratio: 4 / 3;
            background: #f1f1f1;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            margin-bottom: 1.25rem;
        }

        .pd-rel-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .pd-rel-card:hover .pd-rel-img-wrap img,
        .group:hover .pd-rel-img-wrap img {
            transform: scale(1.05);
        }

        .pd-rel-overlay {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, 0.45);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .pd-rel-card:hover .pd-rel-overlay,
        .group:hover .pd-rel-overlay {
            opacity: 1;
        }

        .pd-rel-btn {
            background: #fff;
            color: #0f172a;
            padding: 0.5rem 1.5rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 700;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.18);
            transform: translateY(12px);
            transition: transform 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .pd-rel-card:hover .pd-rel-btn,
        .group:hover .pd-rel-btn {
            transform: translateY(0);
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
@endpush

@section('content')

    {{-- HERO SECTION --}}
    <section class="sd-hero container-custom">
        <h1 class="sd-hero-title animate-on-scroll" style="font-family: 'Neuton', serif;">{{ $service->title }}</h1>
        @if($service->short_description)
            <p class="sd-hero-subtitle animate-on-scroll delay-100">{{ $service->short_description }}</p>
        @endif
    </section>

    {{-- CONTENT GRID --}}
    <section class="container-custom pb-24 mt-8">
        <div class="sd-layout-grid">

            {{-- Left Content --}}
            <div class="animate-on-scroll delay-200">
                @if($service->image || $service->banner_image)
                    <div class="mb-14 rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                        <img src="{{ asset($service->image ?? $service->banner_image) }}" alt="{{ $service->title }}"
                            class="w-full h-auto object-cover aspect-video hover:scale-105 transition-transform duration-700">
                    </div>
                @endif

                @if($service->description)
                    <div class="ckeditor-content text-slate-600 leading-relaxed text-lg pb-10">
                        {!! $service->description !!}
                    </div>
                @endif

                {{-- Related Projects --}}
                @if($service->projects->count())
                    <div class="border-t border-gray-100" style="margin-top: 50px; padding-top: 50px;">
                        <h3 class="text-3xl font-bold mb-10 text-slate-900 border-b-2 inline-block pb-1"
                            style="border-color: var(--theme-color, #c5a059);">
                            {!! setting('service_related_projects_title', 'Related Projects') !!}
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8" style="margin-top: 10px;">
                            @foreach($service->projects->take(4) as $project)
                                <a href="{{ route('portfolio.detail', $project->slug) }}" class="group pd-rel-card block">
                                    <div
                                        class="pd-rel-img-wrap mb-4 shadow-sm border border-gray-100 rounded-xl overflow-hidden aspect-[4/3]">
                                        <img src="{{ $project->image ? asset($project->image) : asset('assets/img/portfolio/portfolio2_1.jpg') }}"
                                            alt="{{ $project->title }}" class="w-full h-full object-cover" />
                                        <div class="pd-rel-overlay">
                                            <span class="pd-rel-btn">View Project</span>
                                        </div>
                                    </div>
                                    <h4 class="text-xl font-bold text-slate-900 group-hover:text-[#4E7CC1] transition-colors mb-1">
                                        {{ $project->title }}
                                    </h4>
                                    <p class="text-[1.1rem] tracking-wide text-slate-500">
                                        {{ $project->categories->first()->name ?? 'Portfolio' }}
                                    </p>
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
                                    class="sd-menu-link {{ $service->id == $related->id ? 'active font-bold text-[#4E7CC1]' : '' }}">
                                    {{ $related->title }}
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
                                <span class="flex items-center justify-center w-12 h-12 rounded bg-icon-box text-[#4E7CC1]">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                    </svg>
                                </span>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['site_phone']) }}"
                                    class="font-bold text-lg tracking-wide">{{ $siteSettings['site_phone'] }}</a>
                            </div>
                        @endif
                        @if(!empty($siteSettings['site_email']))
                            <div class="sd-contact-row mt-4">
                                <span class="flex items-center justify-center w-12 h-12 rounded bg-icon-box text-[#4E7CC1]">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <rect width="20" height="16" x="2" y="4" rx="2" />
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                    </svg>
                                </span>
                                <a href="mailto:{{ $siteSettings['site_email'] }}"
                                    class="font-bold text-lg tracking-wide">{{ $siteSettings['site_email'] }}</a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Tags Widget --}}
                @if($service->tags && $service->tags->count())
                    <div class="sd-widget">
                        <h4 class="sd-widget-title">{!! setting('service_tags_title', 'Tags') !!}</h4>
                        <div class="flex flex-wrap mt-2">
                            @foreach($service->tags as $tag)
                                <span class="sd-tag">#{{ $tag->title }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="container-custom border-t border-gray-100" style="padding-top: 50px;">
        <div class="pt-16 mb-6 flex flex-col md:flex-row md:items-end md:justify-between gap-6 animate-on-scroll">
            <div>
                <span class="text-sm font-medium uppercase tracking-wider" style="color: var(--theme-color, #c5a059);">How
                    We
                    Work</span>
                <h2 class="text-2xl lg:text-4xl font-semibold leading-tight mt-2"
                    style="color: var(--title-color, #1a1a1a);">Our
                    Process</h2>
            </div>
        </div>
        <!-- <p class="text-base leading-relaxed text-slate-500 max-w-sm mb-6">A proven framework that transforms your vision into
                    measurable results, step by step.</p> -->

        <div class="mx-auto" style="max-width: 95%;">
            <style>
                .process-card {
                    /* ensure transition is smooth */
                    transition: all 0.3s ease;
                }

                .process-card:hover {
                    border-color: var(--theme-color, #c5a059) !important;
                }

                .process-card:hover .process-icon {
                    background: var(--theme-color, #c5a059) !important;
                    color: #ffffff !important;
                }
            </style>
            <div class="flex flex-col md:flex-row flex-nowrap gap-4">

                {{-- Step 1: Discovery --}}
                <div class="group relative animate-on-scroll border border-gray-100 p-4 lg:p-5 transition-all duration-300 hover:shadow-lg hover:z-10 flex-1 min-w-0 process-card"
                    style="--step-color: var(--theme-color, #c5a059);">
                    <div class="flex items-start gap-2 mb-2">
                        <span class="text-3xl font-bold leading-none opacity-10 group-hover:opacity-20 transition-opacity"
                            style="color: var(--theme-color, #c5a059);">01</span>
                    </div>
                    <div class="process-icon rounded-lg flex items-center justify-center border-none transition-colors duration-300"
                        style="width: 45px; height: 45px; margin-bottom: 15px; background: color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent); color: var(--theme-color, #c5a059);">
                        <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.3-4.3" />
                        </svg>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-semibold mb-2" style="color: var(--title-color, #1a1a1a);">Discovery
                    </h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Understanding your goals, audience, and
                        challenges.</p>
                </div>

                {{-- Step 2: Strategy --}}
                <div
                    class="group relative animate-on-scroll delay-100 border border-gray-100 p-4 lg:p-5 transition-all duration-300 hover:shadow-lg hover:z-10 flex-1 min-w-0 process-card">
                    <div class="flex items-start gap-2 mb-2">
                        <span class="text-3xl font-bold leading-none opacity-10 group-hover:opacity-20 transition-opacity"
                            style="color: var(--theme-color, #c5a059);">02</span>
                    </div>
                    <div class="process-icon rounded-lg flex items-center justify-center border-none transition-colors duration-300"
                        style="width: 45px; height: 45px; margin-bottom: 15px; background: color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent); color: var(--theme-color, #c5a059);">
                        <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M21.21 15.89A10 10 0 1 1 8 2.83" />
                            <path d="M22 12A10 10 0 0 0 12 2v10z" />
                        </svg>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-semibold mb-2" style="color: var(--title-color, #1a1a1a);">Strategy
                    </h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Crafting a data-driven roadmap aligned with
                        your objectives.</p>
                </div>

                {{-- Step 3: Design --}}
                <div
                    class="group relative animate-on-scroll delay-200 border border-gray-100 p-4 lg:p-5 transition-all duration-300 hover:shadow-lg hover:z-10 flex-1 min-w-0 process-card">
                    <div class="flex items-start gap-2 mb-2">
                        <span class="text-3xl font-bold leading-none opacity-10 group-hover:opacity-20 transition-opacity"
                            style="color: var(--theme-color, #c5a059);">03</span>
                    </div>
                    <div class="process-icon rounded-lg flex items-center justify-center border-none transition-colors duration-300"
                        style="width: 45px; height: 45px; margin-bottom: 15px; background: color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent); color: var(--theme-color, #c5a059);">
                        <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="13.5" cy="6.5" r=".5" fill="currentColor" />
                            <circle cx="17.5" cy="10.5" r=".5" fill="currentColor" />
                            <circle cx="8.5" cy="7.5" r=".5" fill="currentColor" />
                            <circle cx="6.5" cy="12.5" r=".5" fill="currentColor" />
                            <path
                                d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-semibold mb-2" style="color: var(--title-color, #1a1a1a);">Design
                    </h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Creating intuitive interfaces that engage
                        and elevate.</p>
                </div>

                {{-- Step 4: Development --}}
                <div
                    class="group relative animate-on-scroll delay-300 border border-gray-100 p-4 lg:p-5 transition-all duration-300 hover:shadow-lg hover:z-10 flex-1 min-w-0 process-card">
                    <div class="flex items-start gap-2 mb-2">
                        <span class="text-3xl font-bold leading-none opacity-10 group-hover:opacity-20 transition-opacity"
                            style="color: var(--theme-color, #c5a059);">04</span>
                    </div>
                    <div class="process-icon rounded-lg flex items-center justify-center border-none transition-colors duration-300"
                        style="width: 45px; height: 45px; margin-bottom: 15px; background: color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent); color: var(--theme-color, #c5a059);">
                        <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <polyline points="16 18 22 12 16 6" />
                            <polyline points="8 6 2 12 8 18" />
                        </svg>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-semibold mb-2" style="color: var(--title-color, #1a1a1a);">
                        Development</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Building high-performance systems with
                        clean code.</p>
                </div>

                {{-- Step 5: QA and Testing --}}
                <div
                    class="group relative animate-on-scroll delay-[350ms] border border-gray-100 p-4 lg:p-5 transition-all duration-300 hover:shadow-lg hover:z-10 flex-1 min-w-0 process-card">
                    <div class="flex items-start gap-2 mb-2">
                        <span class="text-3xl font-bold leading-none opacity-10 group-hover:opacity-20 transition-opacity"
                            style="color: var(--theme-color, #c5a059);">05</span>
                    </div>
                    <div class="process-icon rounded-lg flex items-center justify-center border-none transition-colors duration-300"
                        style="width: 45px; height: 45px; margin-bottom: 15px; background: color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent); color: var(--theme-color, #c5a059);">
                        <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            <path d="m9 12 2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-semibold mb-2" style="color: var(--title-color, #1a1a1a);">QA &
                        Testing</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Rigorous testing to ensure flawless performance and
                        security.
                    </p>
                </div>

                {{-- Step 6: Launch --}}
                <div
                    class="group relative animate-on-scroll delay-400 border border-gray-100 p-4 lg:p-5 transition-all duration-300 hover:shadow-lg hover:z-10 flex-1 min-w-0 process-card">
                    <div class="flex items-start gap-2 mb-2">
                        <span class="text-3xl font-bold leading-none opacity-10 group-hover:opacity-20 transition-opacity"
                            style="color: var(--theme-color, #c5a059);">06</span>
                    </div>
                    <div class="process-icon rounded-lg flex items-center justify-center border-none transition-colors duration-300"
                        style="width: 45px; height: 45px; margin-bottom: 15px; background: color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent); color: var(--theme-color, #c5a059);">
                        <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z" />
                            <path
                                d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z" />
                            <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0" />
                            <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5" />
                        </svg>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-semibold mb-2" style="color: var(--title-color, #1a1a1a);">Launch
                    </h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Deploying with precision and monitoring
                        performance.</p>
                </div>

            </div>
        </div>
    </section>

@endsection