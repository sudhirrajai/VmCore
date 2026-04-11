@extends('layouts.app')

@section('title', ($project->meta_title ?? $project->title) . ' - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', $project->meta_description ?? $project->short_description ?? '')
@section('meta_keywords', $project->tags->count() ? $project->tags->pluck('title')->implode(', ') : '')
@section('canonical', route('portfolio.detail', $project->slug))

@if($project->image)
@section('og_image', asset($project->image))
@endif

@push('structured_data')
    <script type="application/ld+json">
            {
                "@@context": "https://schema.org",
                "@@type": "CreativeWork",
                "name": "{{ addslashes($project->title) }}",
                "description": "{{ addslashes($project->meta_description ?? $project->short_description ?? '') }}",
                "image": "{{ $project->image ? asset($project->image) : '' }}",
                "url": "{{ route('portfolio.detail', $project->slug) }}",
                "creator": {
                    "@@type": "Organization",
                    "name": "{{ addslashes($siteSettings['site_name'] ?? 'VMCore') }}"
                }{{ $project->project_date ? ', "dateCreated": "' . $project->project_date->toDateString() . '"' : '' }}
            }
            </script>
@endpush

@push('styles')


    <style>
        /* ══════════════════════════════════════════
               DESIGN SYSTEM — matching reference exactly
               Font: Neuton (serif) for headings
               Accent: theme-color mapped to gold role
            ══════════════════════════════════════════ */


        /* ── SECTION 1: HERO ── */
        .pd-hero {
            padding: 3.5rem 0 2rem; /* Reduced from 5rem 0 3rem */
            overflow: hidden;
        }

        .pd-hero-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 2.5rem; /* Reduced from 4rem */
        }

        .pd-hero-title {
            color: var(--title-color, #1a1a1a);
        }

        .pd-hero-subtitle {
            color: var(--theme-color, #c5a059);
        }

        /* Image showcase frame */
        .pd-hero-showcase {
            position: relative;
            max-width: 900px; /* Reduced from 1080px to make hero more compact */
            margin: 0 auto;
        }

        .pd-hero-frame {
            position: relative;
            z-index: 1;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 1px solid color-mix(in srgb, var(--theme-color, #c5a059) 20%, transparent);
            background: #fff;
            padding: 1rem;
        }

        .pd-hero-frame img {
            width: 100%;
            display: block;
            border-radius: 0.5rem;
        }

        /* Decorative blur circles */
        .pd-blur-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            pointer-events: none;
        }

        .pd-blur-circle--br {
            width: 256px;
            height: 256px;
            background: color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent);
            bottom: -40px;
            right: -40px;
        }

        .pd-blur-circle--tl {
            width: 256px;
            height: 256px;
            background: color-mix(in srgb, var(--theme-color, #c5a059) 5%, transparent);
            top: -40px;
            left: -40px;
        }

        /* ── SECTION 2: THE STORY + QUICK FACTS ── */
        .pd-story-section {
            background: var(--card-bg-color, #ffffff);
        }

        .pd-story-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 3rem;
            align-items: start;
        }

        .pd-sticky-sidebar {
            position: sticky;
            top: 8rem; /* Enough room for headers/nav */
            padding-bottom: 2rem;
            z-index: 10;
        }

        @media (min-width: 768px) {
            .pd-story-grid {
                grid-template-columns: 2fr 1fr;
                gap: 4rem;
            }
        }

        .pd-story-heading {
            color: var(--title-color, #1a1a1a);
        }

        .pd-story-text {
            color: var(--body-color, #666666);
        }

        .pd-story-text p {
            margin-bottom: 1.25rem;
        }

        .pd-story-text p:last-child {
            margin-bottom: 0;
        }

        /* Quick Facts card */
        .pd-facts-card {
            background: var(--card-bg-color, #fdfbf7);
            border: 1px solid color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent);
            border-radius: 1rem;
            padding: 2.5rem; /* Increased spacing inside */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
        }

        .pd-facts-card:hover {
            border-color: color-mix(in srgb, var(--theme-color, #c5a059) 60%, transparent);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
        }

        .pd-facts-title {
            color: var(--title-color, #1a1a1a);
        }

        .pd-fact-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            padding-bottom: 0.85rem; /* Increased vertical spacing */
            margin-bottom: 0.85rem;
            border-bottom: 1px solid color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent);
            gap: 1rem;
        }

        .pd-fact-row:last-child {
            border-bottom: none;
            margin-bottom: 1.25rem; /* Bottom spacing before button */
            padding-bottom: 0;
        }

        .pd-fact-label {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--body-color, #666666);
            white-space: nowrap;
        }

        .pd-fact-value {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--title-color, #1a1a1a);
            text-align: right;
        }

        /* ── SECTION 3: PROBLEM & SOLUTION ── */
        .pd-ps-section-title {
            color: var(--title-color, #1a1a1a);
            text-align: center;
        }

        .pd-ps-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .pd-ps-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        .pd-ps-card {
            background: var(--card-bg-color, #ffffff);
            padding: 3.5rem 2.5rem;
            /* Massive spacing inside */
            border-radius: 1.5rem;
            border: 1px solid color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .pd-ps-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
            border-color: color-mix(in srgb, var(--theme-color, #c5a059) 60%, transparent);
        }

        .pd-ps-icon {
            width: 64px;
            height: 64px;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            background: color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent);
            color: var(--theme-color, #c5a059);
        }

        .pd-ps-card-title {
            color: var(--title-color, #1a1a1a);
        }

        .pd-ps-card-text {
            color: var(--body-color, #666666);
        }

        /* ── SECTION 4: FEATURE HIGHLIGHTS ── */
        .pd-feat-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .pd-feat-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .pd-feat-card {
            background: var(--card-bg-color, #ffffff);
            border: 1px solid transparent;
            /* invisible border until hover */
            border-radius: 1.25rem;
            text-align: center;
            padding: 3.5rem 2.5rem;
            /* Massive spacing inside */
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .pd-feat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.06);
            border-color: color-mix(in srgb, var(--theme-color, #c5a059) 60%, transparent);
        }

        .pd-feat-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            background: color-mix(in srgb, var(--theme-color, #c5a059) 6%, transparent);
            border: 1px solid color-mix(in srgb, var(--theme-color, #c5a059) 20%, transparent);
            color: var(--theme-color, #c5a059);
        }

        .pd-feat-title {
            color: var(--title-color, #1a1a1a);
        }

        .pd-feat-desc {
            color: var(--body-color, #666666);
        }

        /* ── SECTION 5: UI GALLERY ── */
        .pd-gallery-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .pd-gallery-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .pd-gallery-item {
            position: relative;
            border-radius: 1.5rem;
            overflow: hidden;
            border: 1px solid color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            background: #fff;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .pd-gallery-item:hover {
            transform: scale(1.02);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.14);
        }

        @media (min-width: 768px) {
            .pd-gallery-wide {
                grid-column: span 2;
            }
        }

        .pd-gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .pd-gallery-item:hover img {
            transform: scale(1.1);
        }

        /* Gallery fixed heights for consistent look */
        .pd-gallery-item {
            min-height: 240px;
        }

        @media (min-width: 768px) {
            .pd-gallery-item {
                min-height: 320px;
            }

            .pd-gallery-wide {
                min-height: 400px;
            }
        }

        /* Hover overlay */
        .pd-gallery-overlay {
            position: absolute;
            inset: 0;
            background: rgba(26, 26, 26, 0.20);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .pd-gallery-item:hover .pd-gallery-overlay {
            opacity: 1;
        }

        .pd-gallery-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.90);
            backdrop-filter: blur(8px);
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--title-color, #1a1a1a);
        }

        .pd-gallery-pill svg {
            color: var(--theme-color, #c5a059);
        }

        /* ── SECTION 6: TESTIMONIALS ── */
        .pd-test-card {
            background: var(--card-bg-color, #ffffff);
            border: 1px solid color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent);
            border-radius: 1.25rem;
            padding: 2.25rem;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            transition: box-shadow 0.28s ease, transform 0.28s ease;
        }

        .pd-test-card:hover {
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.10);
            transform: translateY(-3px);
        }

        .pd-test-quote {
            color: var(--body-color, #666666);
        }

        .pd-test-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--theme-color, #c5a059);
            color: #fff;
            font-weight: 700;
            font-size: 1.05rem;
            flex-shrink: 0;
        }

        /* ── SECTION 7: RELATED PROJECTS ── */
        .pd-rel-card {
            display: block;
            text-decoration: none;
            cursor: pointer;
        }

        .pd-rel-img-wrap {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            aspect-ratio: 3 / 4;
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

        .pd-rel-card:hover .pd-rel-img-wrap img {
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

        .pd-rel-card:hover .pd-rel-overlay {
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
        }

        .pd-rel-card:hover .pd-rel-btn {
            transform: translateY(0);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 767px) {
            .pd-hero {
                padding: 3rem 0 2rem;
            }

            .pd-hero-center {
                margin-bottom: 2.5rem;
            }

            .pd-hero-frame {
                padding: 0.5rem;
            }

            .pd-blur-circle {
                display: none;
            }
        }
    </style>
@endpush

@section('content')

    {{-- ════════════════════════════════════════════════════════
    1. HERO — Centered Title + Featured Image
    ════════════════════════════════════════════════════════ --}}
    <section class="pd-hero">
        <div class="container-custom">

            {{-- Centered title block --}}
            <div class="pd-hero-center animate-on-scroll">
                <h1 class="pd-hero-title text-5xl lg:text-7xl font-bold leading-tight mb-6">{{ $project->title }}</h1>
                @if($project->short_description)
                    <p class="pd-hero-subtitle text-base leading-relaxed text-slate-500">{{ $project->short_description }}</p>
                @elseif($project->categories->count())
                    <p class="pd-hero-subtitle text-base leading-relaxed text-slate-500">{{ $project->categories->pluck('title')->implode(' · ') }}</p>
                @endif
            </div>

            {{-- Featured image in white frame --}}
            @if($project->image)
                <div class="pd-hero-showcase animate-on-scroll">
                    <div class="pd-hero-frame">
                        <img src="{{ asset($project->image) }}" alt="{{ $project->title }}" />
                    </div>
                    <div class="pd-blur-circle pd-blur-circle--br"></div>
                    <div class="pd-blur-circle pd-blur-circle--tl"></div>
                </div>
            @endif

        </div>
    </section>

    {{-- ════════════════════════════════════════════════════════
    2. THE STORY + QUICK FACTS
    ════════════════════════════════════════════════════════ --}}
    <section class="pd-story-section py-20 md:py-24">
        <div class="container-custom">
            <div class="pd-story-grid">

                {{-- Left: The Story --}}
                <div class="animate-on-scroll">
                    <h2 class="pd-story-heading text-2xl lg:text-4xl font-semibold leading-tight mb-6">{!! setting('portfolio_story_title', 'The Story') !!}</h2>
                    @if($project->short_description)
                        <div class="pd-story-text text-base leading-relaxed text-slate-500 mb-4">
                            <p>{{ $project->short_description }}</p>
                        </div>
                    @endif
                    @if($project->description)
                        <div class="pd-story-text ckeditor-content text-base leading-relaxed text-slate-500">
                            {!! $project->description !!}
                        </div>
                    @endif
                </div>

                {{-- Right: Quick Facts --}}
                <div class="pd-sticky-sidebar">
                    <div class="animate-on-scroll" style="transition-delay: 120ms;">
                        <div class="pd-facts-card">
                            <h3 class="pd-facts-title text-xl lg:text-2xl font-semibold mb-4">{!! setting('portfolio_facts_title', 'Quick Facts') !!}</h3>
                        <div>
                            @if($project->client)
                                <div class="pd-fact-row">
                                    <span class="pd-fact-label">{!! setting('portfolio_fact_client_label', 'Client') !!}</span>
                                    <span class="pd-fact-value">{{ $project->client }}</span>
                                </div>
                            @endif
                            @if($project->categories->count())
                                <div class="pd-fact-row">
                                    <span class="pd-fact-label">{!! setting('portfolio_fact_industry_label', 'Industry') !!}</span>
                                    <span class="pd-fact-value">{{ $project->categories->pluck('title')->implode(', ') }}</span>
                                </div>
                            @endif
                            @if($project->tags->count())
                                <div class="pd-fact-row">
                                    <span class="pd-fact-label">{!! setting('portfolio_fact_tech_label', 'Tech') !!}</span>
                                    <span class="pd-fact-value">{{ $project->tags->pluck('title')->implode(', ') }}</span>
                                </div>
                            @endif
                            @if($project->services->count())
                                <div class="pd-fact-row">
                                    <span class="pd-fact-label">{!! setting('portfolio_fact_services_label', 'Services') !!}</span>
                                    <span class="pd-fact-value">{{ $project->services->pluck('title')->implode(', ') }}</span>
                                </div>
                            @endif
                            @if($project->project_date)
                                <div class="pd-fact-row">
                                    <span class="pd-fact-label">{!! setting('portfolio_fact_date_label', 'Date') !!}</span>
                                    <span class="pd-fact-value">{{ \Carbon\Carbon::parse($project->project_date)->format('M Y') }}</span>
                                </div>
                            @endif
                        </div>

                        @if($project->project_url)
                            <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center justify-center gap-2 w-full mt-5 px-5 py-3 rounded-lg text-sm font-bold tracking-wide text-white transition-all hover:-translate-y-0.5"
                                style="background-color: var(--theme-color, #c5a059); box-shadow: 0 4px 14px color-mix(in srgb, var(--theme-color) 35%, transparent);">
                                {!! setting('portfolio_visit_button_text', 'Visit Project') !!}
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M7 17 17 7" />
                                    <path d="M7 7h10v10" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════════
    2.5 DYNAMIC CONTENT
    ════════════════════════════════════════════════════════ --}}
    @if($project->dynamic_content)
        <section class="py-20 md:py-24 animate-on-scroll">
            <div class="container-custom">
                <div class="ckeditor-content pd-story-text">
                    {!! $project->dynamic_content !!}
                </div>
            </div>
        </section>
    @endif

    {{-- ════════════════════════════════════════════════════════
    3. PROBLEM & SOLUTION
    ════════════════════════════════════════════════════════ --}}
    @if(!empty($project->problem_solution))
        <section class="py-12 md:py-16">
                    <div class="container-custom">

                        <h2 class="pd-ps-section-title animate-on-scroll text-2xl lg:text-4xl font-semibold leading-tight mb-6">{!! setting('portfolio_problem_title', 'Problem &amp; Solution') !!}</h2>

                        <div class="pd-ps-grid">
                            @foreach($project->problem_solution as $index => $item)
                                <div class="pd-ps-card animate-on-scroll" style="transition-delay: {{ $index * 100 }}ms;">
                                    @if(!empty($item['icon']))
                                        <div class="pd-ps-icon">
                                            {!! $item['icon'] !!}
                                        </div>
                                    @endif
                                    <h3 class="pd-ps-card-title text-xl lg:text-2xl font-semibold mb-2">{{ $item['title'] }}</h3>
                                    <p class="pd-ps-card-text text-base leading-relaxed text-slate-500">
                                        {{ $item['content'] ?? '' }}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </section>
    @endif

        {{-- ════════════════════════════════════════════════════════
        4. FEATURE HIGHLIGHTS
        ════════════════════════════════════════════════════════ --}}
        @if(!empty($project->features))
            <section class="py-12 md:py-16" style="background: var(--card-bg-color, #ffffff);">
                <div class="container-custom">

                    <h2 class="pd-ps-section-title animate-on-scroll text-2xl lg:text-4xl font-semibold leading-tight mb-6">{!! setting('portfolio_features_title', 'Feature Highlights') !!}</h2>

                    <div class="pd-feat-grid">
                        @foreach($project->features as $index => $feature)
                            <div class="pd-feat-card animate-on-scroll" style="transition-delay: {{ $index * 80 }}ms;">
                                @if(!empty($feature['icon']))
                                    <div class="pd-feat-icon">
                                        {!! $feature['icon'] !!}
                                    </div>
                                @endif
                                <h3 class="pd-feat-title text-xl lg:text-2xl font-semibold mb-2">{{ $feature['title'] }}</h3>
                                <p class="pd-feat-desc text-base leading-relaxed text-slate-500">{{ $feature['content'] ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>

                </div>
            </section>
        @endif

        {{-- ════════════════════════════════════════════════════════
        5. UI GALLERY
        ════════════════════════════════════════════════════════ --}}
        @if($project->images->count())
            <section class="py-20 md:py-24">
                <div class="container-custom">

                    <h2 class="pd-ps-section-title animate-on-scroll text-2xl lg:text-4xl font-semibold leading-tight mb-6">{!! setting('portfolio_gallery_section_title', 'UI Gallery') !!}</h2>

                    <div class="pd-gallery-grid">
                        @foreach($project->images as $index => $image)
                            <div class="pd-gallery-item {{ ($index % 4 == 0) ? 'pd-gallery-wide' : '' }} group animate-on-scroll"
                                style="transition-delay: {{ ($index % 3) * 60 }}ms;">
                                <img src="{{ asset($image->image) }}" alt="Gallery Image {{ $index + 1 }}" />
                                <div class="pd-gallery-overlay">
                                    <div class="pd-gallery-pill">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                        View
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </section>
        @endif

        {{-- ════════════════════════════════════════════════════════
        6. CLIENT TESTIMONIALS (kept from original, matches style)
        ════════════════════════════════════════════════════════ --}}
        @if($project->testimonials->count())
            <section class="py-20 md:py-24" style="background: var(--card-bg-color, #ffffff);">
                <div class="container-custom">

                    <h2 class="pd-ps-section-title animate-on-scroll text-2xl lg:text-4xl font-semibold leading-tight mb-6">{!! setting('portfolio_feedback_title', 'Client Feedback') !!}</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($project->testimonials as $testimonial)
                            <div class="pd-test-card animate-on-scroll">
                                <p class="pd-test-quote text-base leading-relaxed text-slate-500 mb-6 italic">"{{ $testimonial->content }}"</p>
                                <div class="flex items-center gap-3.5">
                                    <div class="pd-test-avatar">{{ strtoupper(substr($testimonial->name, 0, 1)) }}</div>
                                    <div>
                                        <h4 class="font-bold text-sm">
                                            {{ $testimonial->name }}</h4>
                                        @if($testimonial->designation)
                                            <p class="text-xs text-slate-500 mt-0.5">
                                                {{ $testimonial->designation }}@if($testimonial->company), {{ $testimonial->company }}@endif
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </section>
        @endif

        {{-- ════════════════════════════════════════════════════════
        7. RELATED PROJECTS (matching home page card style)
        ════════════════════════════════════════════════════════ --}}
        @if($relatedProjects->count())
            <section class="py-20 md:py-24">
                <div class="container-custom">

                    <div class="mb-14 animate-on-scroll">
                        <span class="text-sm font-medium uppercase tracking-wider"
                            style="color: var(--theme-color, #c5a059);">{!! setting('portfolio_related_label', 'Projects') !!}</span>
                        <h2 class="text-2xl lg:text-4xl font-semibold leading-tight mt-2 mb-6 uppercase tracking-tight"
                            style="color: var(--title-color, #0f172a);">{!! setting('portfolio_related_heading', 'Discover Related Work') !!}</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                        @foreach($relatedProjects as $index => $related)
                            <div class="pd-rel-card animate-on-scroll" style="transition-delay: {{ $index * 100 }}ms;">
                                <a href="{{ route('portfolio.detail', $related->slug) }}" class="block">
                                    <div class="pd-rel-img-wrap">
                                        <img src="{{ $related->image ? asset($related->image) : '' }}" alt="{{ $related->title }}" />
                                        <div class="pd-rel-overlay">
                                            <span class="pd-rel-btn">{!! setting('portfolio_view_button_text', 'View Project') !!}</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="mt-1">
                                    <h3 class="text-xl lg:text-2xl font-semibold mb-2" style="color: var(--title-color, #0f172a);">
                                        {{ $related->title }}</h3>
                                    <p class="text-sm text-slate-500">
                                        {{ $related->categories->first()->name ?? 'Portfolio' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </section>
        @endif

@endsection