@extends('layouts.app')

@section('title', setting('home_meta_title', 'Home - ' . ($siteSettings['site_name'] ?? 'VM CORE')))
@section('meta_description', setting('home_meta_description', 'We are a digital agency that helps build immersive and engaging user experiences that drive results.'))
@section('meta_keywords', setting('home_meta_keywords', 'digital agency, web design, branding, creative studio'))
@section('og_type', 'website')
@section('canonical', url('/'))

@push('structured_data')
  <script type="application/ld+json">
          {
              "@@context": "https://schema.org",
              "@@type": "WebSite",
              "name": "{{ addslashes($siteSettings['site_name'] ?? 'VMCore') }}",
              "url": "{{ url('/') }}",
              "potentialAction": {
                  "@@type": "SearchAction",
                  "target": "{{ url('/blog') }}?search={search_term_string}",
                  "query-input": "required name=search_term_string"
              }
          }
          </script>
@endpush

@push('styles')
  <style>
    /* Project card hover overlay */
    .proj-card {
      cursor: pointer;
    }

    .proj-card .proj-img {
      transition: transform 0.5s ease;
    }

    .proj-card:hover .proj-img {
      transform: scale(1.05);
    }

    .proj-card .proj-overlay {
      position: absolute;
      inset: 0;
      background: rgba(15, 23, 42, 0.45);
      opacity: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: opacity 0.3s ease;
    }

    .proj-card:hover .proj-overlay {
      opacity: 1;
    }

    .proj-card .proj-btn {
      background: #fff;
      color: #0f172a;
      padding: 0.5rem 1.5rem;
      border-radius: 0.375rem;
      font-size: 0.875rem;
      font-weight: 700;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.18);
      transform: translateY(12px);
      transition: transform 0.3s ease;
      white-space: nowrap;
    }

    .proj-card:hover .proj-btn {
      transform: translateY(0);
    }

    /* ── Mobile Responsiveness ── */
    @media (max-width: 767px) {

      /* Prevent horizontal overflow */
      body,
      html {
        overflow-x: hidden !important;
        max-width: 100vw !important;
      }

      /* Hero Section — single column, centered on mobile */
      .home-hero .hero-grid {
        grid-template-columns: 1fr !important;
        gap: 2rem !important;
        text-align: center;
      }

      .home-hero .hero-grid>div:first-child {
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .home-hero h1 {
        font-size: 2.25rem !important;
        /* text-4xl */
        line-height: 1.2 !important;
      }

      .home-hero p {
        max-width: 100% !important;
        text-align: center;
      }

      /* Services — single column */
      .services-grid {
        grid-template-columns: 1fr !important;
        gap: 1.25rem !important;
      }

      /* Projects — single column */
      .projects-grid {
        grid-template-columns: 1fr !important;
        gap: 2.5rem !important;
      }

      /* Project aspect ratio for mobile */
      .projects-grid .aspect-\[3\/4\] {
        aspect-ratio: 4/3 !important;
      }

      /* Reduce section padding on mobile */
      section.py-24 {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
      }

      section.py-12 {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
      }

      section.pb-12 {
        padding-bottom: 2rem !important;
      }

      /* Reduce heading font sizes for mobile */
      h2.text-4xl,
      h2.text-2xl {
        font-size: 1.5rem !important;
      }

      /* Service card layout — stack vertically */
      .service-card {
        flex-direction: column !important;
        gap: 1rem !important;
        padding: 1.25rem !important;
      }
    }
  </style>
@endpush

@section('content')

  <!-- Hero Section -->
  <section class="pb-12 home-hero">
    <div class="container-custom">
      <div class="hero-grid grid md:grid-cols-2 gap-12 items-center">
        <div class="animate-fade-in-left">
          <h1 class="text-4xl md:text-5xl lg:text-7xl font-bold leading-tight text-slate-900 mb-6">
            @if(isset($hero) && $hero)
              {!! $hero->title !!}
            @else
              {!! setting('home_hero_fallback_title', 'WE MAKE <br /> CREATIVE THINGS <br /> EVERYDAY') !!}
            @endif
          </h1>
          <p class="text-base leading-relaxed text-slate-600 mb-6 max-w-md">
            @if(isset($hero) && $hero)
              {!! $hero->description !!}
            @else
              {!! setting('home_hero_fallback_description', 'We are a digital agency that helps build immersive and engaging user experiences that drive results.') !!}
            @endif
          </p>
          <a href="{{ route('portfolio') }}"
            class="inline-flex bg-[#4E7CC1] text-white px-8 py-4 rounded-md text-sm font-medium items-center gap-2 hover:bg-[#3d66a3] transition-all shadow-md">
            {!! setting('home_hero_button_text', 'VIEW OUR WORKS') !!}
          </a>
        </div>
        <div class="relative animate-fade-in-up delay-200">
          <img
            src="{{ isset($hero) && $hero->image ? asset($hero->image) : 'https://picsum.photos/seed/vmcore-meeting/800/600' }}"
            alt="{{ isset($hero) && $hero->image_alt ? $hero->image_alt : ($siteSettings['site_name'] ?? 'VMCore') . ' - Digital Agency Team' }}"
            class="rounded-3xl shadow-2xl w-full object-cover aspect-[4/3]" loading="eager" />
        </div>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section id="services" class="py-12">
    <div class="container-custom">
      <div class="mb-8 md:mb-14">
        <span
          class="text-sm font-medium text-secondary uppercase tracking-wider">{!! setting('home_services_label', 'Services') !!}</span>
        <h2 class="text-xl md:text-2xl lg:text-4xl font-semibold leading-tight text-slate-900 mt-2 mb-4 md:mb-6">
          {!! setting('home_services_heading', 'What We Can Do for Our Clients') !!}
        </h2>
      </div>
      <div class="services-grid grid md:grid-cols-2 gap-6 md:gap-8">
        @if(isset($services) && $services->count() > 0)
          @foreach($services as $index => $service)
            <a href="{{ route('service.detail', $service->slug ?? '') }}"
              class="service-card bg-card py-5 px-5 rounded-2xl border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex flex-col md:flex-row gap-4 md:gap-8 items-start group cursor-pointer hover:-translate-y-1 transition-transform animate-on-scroll">
              <div class="bg-icon-box p-6 rounded-2xl group-hover:bg-slate-100 transition-colors flex-shrink-0">
                @if($service->icon_image)
                  <img src="{{ asset($service->icon_image) }}" alt="{{ $service->title }}" class="w-7 h-7 object-contain">
                @else
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-slate-900" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5">
                    <rect width="8" height="8" x="3" y="3" rx="2" ry="2" />
                    <rect width="8" height="8" x="13" y="3" rx="2" ry="2" />
                    <rect width="8" height="8" x="13" y="13" rx="2" ry="2" />
                    <rect width="8" height="8" x="3" y="13" rx="2" ry="2" />
                  </svg>
                @endif
              </div>
              <div class="pt-2">
                <h3 class="text-xl lg:text-2xl font-semibold text-slate-900 mb-4">{{ $service->title }}</h3>
                <div class="text-base leading-relaxed text-slate-500 mb-4 max-w-[340px] line-clamp-2">
                  {{ \Illuminate\Support\Str::limit(strip_tags($service->description), 80) }}
                </div>
                <div
                  class="flex items-center gap-1.5 text-sm font-medium uppercase tracking-wider text-slate-900 group-hover:text-[#4E7CC1] transition-colors">
                  {!! setting('home_service_link_text', 'VIEW DETAILS') !!}
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M7 17 17 7" />
                    <path d="M7 7h10v10" />
                  </svg>
                </div>
              </div>
            </a>
          @endforeach
        @else
          <div
            class="bg-card p-6 md:p-10 rounded-2xl border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex flex-col md:flex-row gap-4 md:gap-8 items-start group cursor-pointer">
            <p class="text-base leading-relaxed text-slate-500 mb-4 max-w-[340px]">No services found.</p>
          </div>
        @endif
      </div>
    </div>
  </section>

  <!-- Projects Section -->
  <section id="portfolio" class="py-12 md:py-24">
    <div class="container-custom">
      <div class="mb-8 md:mb-14">
        <span
          class="text-sm font-medium text-secondary uppercase tracking-wider">{!! setting('home_projects_label', 'Projects') !!}</span>
        <h2
          class="text-xl md:text-2xl lg:text-4xl font-semibold leading-tight text-slate-900 mt-2 mb-4 md:mb-6 uppercase tracking-tight">
          {!! setting('home_projects_heading', 'Discover Our Selected Projects') !!}
        </h2>
      </div>
      <div class="projects-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 md:gap-12">
        @if(isset($projects) && $projects->count() > 0)
          @foreach($projects as $project)
            <div class="proj-card animate-on-scroll">
              <a href="{{ route('portfolio.detail', $project->slug ?? '') }}" class="block">
                <div class="relative aspect-[4/3] sm:aspect-[3/4] overflow-hidden rounded-2xl bg-slate-100 shadow-sm">
                  <img
                    src="{{ $project->image ? asset($project->image) : 'https://picsum.photos/seed/project-' . $project->id . '/600/800' }}"
                    alt="{{ $project->title }}" class="proj-img w-full h-full object-cover" />
                  {{-- Hover Overlay --}}
                  <div class="proj-overlay">
                    <span class="proj-btn">{!! setting('home_project_overlay_text', 'View Project') !!}</span>
                  </div>
                </div>
              </a>
              <div class="mt-4">
                <h3 class="text-lg md:text-xl lg:text-2xl font-semibold text-slate-900 mb-1">{{ $project->title }}</h3>
                <p class="text-sm text-slate-500">{{ $project->categories->first()->name ?? 'Portfolio' }}</p>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </section>

  <!-- Clients Marquee Section -->
  <section class="client-marquee">
    <div class="marquee-track">
      @if(isset($clients) && $clients->count() > 0)
        @foreach($clients as $client)
          <div class="logo-item opacity-80">
            <img src="{{ asset($client->logo) }}" alt="{{ $client->name ?? 'Client' }}"
              class="h-16 w-auto max-w-[180px] object-contain">
          </div>
        @endforeach
      @else
        {{-- Fallbacks --}}
        @php $fallbacks = ['Google', 'Meta', 'Amazon', 'Apple', 'Netflix', 'Tesla']; @endphp
        @foreach($fallbacks as $f)
          <div class="logo-item text-4xl font-black tracking-tighter opacity-20">{{ $f }}</div>
        @endforeach
      @endif
    </div>
  </section>



@endsection