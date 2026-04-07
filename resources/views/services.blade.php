@extends('layouts.app')

@section('title', setting('services_meta_title', 'Services - ' . ($siteSettings['site_name'] ?? 'VM CORE')))
@section('meta_description', setting('services_meta_description', 'Explore our range of professional services including branding, web design, development, and digital strategy.'))
@section('meta_keywords', setting('services_meta_keywords', 'services, branding, web design, web development, digital strategy, creative agency'))
@section('canonical', route('services'))

@push('structured_data')
  <script type="application/ld+json">
                                                          {
                                                              "@ontext": "https://schema.org",
                                                              "@ype": "BreadcrumbList",
                                                              "imListElement": [
                                                                  {
                                                                      "@ype": "ListItem",
                                                                      "pition": 1,
                                                                      "ne": "Home",
                                                                      "im": "{{ url('/') }}"
                                                                  },
                                                                  {
                                                                      "@ype": "ListItem",
                                                                      "pition": 2,
                                                                      "ne": "Services",
                                                                      "im": "{{ route('services') }}"
                                                                  }
                                                              ]
                                                          }
                                                      </script>
@endpush

@section('content')

  <!-- Services Header -->
  <section class="container-custom pb-20">
    <div class="pt-20 pb-12 px-8 text-center max-w-4xl mx-auto animate-fade-in-up is-visible">
      <h1 class="text-5xl lg:text-7xl font-bold leading-tight text-slate-900 mb-6">
        {!! setting('services_hero_title', 'What We Excel At') !!}
      </h1>
      <p class="text-base leading-relaxed text-slate-500">
        {!! setting('services_hero_subtitle', 'Our Specialized Services') !!}
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @if(isset($services) && $services->count() > 0)
        @foreach($services as $service)
          <a href="{{ route('service.detail', $service->slug ?? '') }}"
            class="flex flex-col gap-4 px-6 py-4 bg-card rounded-sm border border-gray-100 hover:border-[#4A76B2] transition-colors group animate-on-scroll w-full h-full block">
            <div class="flex-shrink-0">
              <div
                class="w-16 h-16 bg-icon-box rounded-lg flex items-center justify-center group-hover:bg-[#4A76B2] transition-colors">
                @if($service->icon_image)
                  <img src="{{ asset($service->icon_image) }}" alt="{{ $service->title }}"
                    class="w-8 h-8 object-contain filter group-hover:brightness-0 group-hover:invert transition-colors">
                @else
                  <svg class="w-8 h-8 text-black group-hover:text-white transition-colors" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect width="8" height="8" x="3" y="3" rx="2" ry="2" />
                    <rect width="8" height="8" x="13" y="3" rx="2" ry="2" />
                    <rect width="8" height="8" x="13" y="13" rx="2" ry="2" />
                    <rect width="8" height="8" x="3" y="13" rx="2" ry="2" />
                  </svg>
                @endif
              </div>
            </div>
            <div class="flex-grow">
              <h3 class="text-xl lg:text-2xl font-semibold mb-2">{{ $service->title }}</h3>
              <div class="text-base leading-relaxed text-slate-500 mb-4 line-clamp-2"
                title="{{ strip_tags($service->description) }}">
                {{ \Illuminate\Support\Str::limit(strip_tags($service->description), 200) }}
              </div>

              <div
                class="mt-4 flex items-center gap-1.5 text-sm font-medium uppercase tracking-wider text-slate-900 group-hover:text-[#4E7CC1] transition-colors">
                VIEW DETAILS
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1"
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </div>
            </div>
          </a>
        @endforeach
      @else
        {{-- Static Fallbacks --}}
        <div
          class="flex flex-col gap-4 px-6 py-4 bg-card rounded-sm border border-gray-100 hover:border-[#4A76B2] transition-colors group animate-on-scroll">
          <div class="flex-shrink-0">
            <div
              class="w-16 h-16 bg-icon-box rounded-lg flex items-center justify-center group-hover:bg-[#4A76B2] transition-colors">
              <svg class="w-8 h-8 text-black group-hover:text-white transition-colors" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect width="8" height="8" x="3" y="3" rx="2" ry="2" />
                <rect width="8" height="8" x="13" y="3" rx="2" ry="2" />
                <rect width="8" height="8" x="13" y="13" rx="2" ry="2" />
                <rect width="8" height="8" x="3" y="13" rx="2" ry="2" />
              </svg>
            </div>
          </div>
          <div class="flex-grow">
            <h3 class="text-xl lg:text-2xl font-semibold mb-2">Business Consultancy</h3>
            <p class="text-base leading-relaxed text-slate-500 mb-4">
              Business consultancy, team skills and engaging user experiences that deliver results.
            </p>
            <ul class="grid grid-cols-1 gap-y-1">
              <li class="flex items-center text-sm font-medium"><span
                  class="w-1.5 h-1.5 bg-black rounded-full mr-3"></span>Strategic Planning</li>
              <li class="flex items-center text-sm font-medium"><span
                  class="w-1.5 h-1.5 bg-black rounded-full mr-3"></span>Digital Transformation</li>
              <li class="flex items-center text-sm font-medium"><span
                  class="w-1.5 h-1.5 bg-black rounded-full mr-3"></span>Operations Scaling</li>
            </ul>

            <div
              class="mt-4 flex items-center gap-1.5 text-sm font-medium uppercase tracking-wider text-slate-900 group-hover:text-[#4E7CC1] transition-colors">
              VIEW DETAILS
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M5 12h14" />
                <path d="m12 5 7 7-7 7" />
              </svg>
            </div>
          </div>
        </div>
      @endif
    </div>
  </section>

  <!-- Process Section -->
  <section class="container-custom" style="padding-top: 50px;">
    <div class="pt-16 mb-6 flex flex-col md:flex-row md:items-end md:justify-between gap-6 animate-on-scroll">
      <div>
        <span class="text-sm font-medium uppercase tracking-wider" style="color: var(--theme-color, #c5a059);">How We
          Work</span>
        <h2 class="text-2xl lg:text-4xl font-semibold leading-tight mt-2" style="color: var(--title-color, #1a1a1a);">Our
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
        <div
          class="group relative animate-on-scroll border border-gray-100 p-4 lg:p-5 transition-all duration-300 hover:shadow-lg hover:z-10 flex-1 min-w-0 process-card"
          style="--step-color: var(--theme-color, #c5a059);">
          <div class="flex items-start gap-2 mb-2">
            <span class="text-3xl font-bold leading-none opacity-10 group-hover:opacity-20 transition-opacity"
              style="color: var(--theme-color, #c5a059);">01</span>
          </div>
          <div class="process-icon rounded-lg flex items-center justify-center border-none transition-colors duration-300"
            style="width: 45px; height: 45px; margin-bottom: 15px; background: color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent); color: var(--theme-color, #c5a059);">
            <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8" />
              <path d="m21 21-4.3-4.3" />
            </svg>
          </div>
          <h3 class="text-xl lg:text-2xl font-semibold mb-2" style="color: var(--title-color, #1a1a1a);">Discovery</h3>
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
            <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21.21 15.89A10 10 0 1 1 8 2.83" />
              <path d="M22 12A10 10 0 0 0 12 2v10z" />
            </svg>
          </div>
          <h3 class="text-xl lg:text-2xl font-semibold mb-2" style="color: var(--title-color, #1a1a1a);">Strategy</h3>
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
            <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="13.5" cy="6.5" r=".5" fill="currentColor" />
              <circle cx="17.5" cy="10.5" r=".5" fill="currentColor" />
              <circle cx="8.5" cy="7.5" r=".5" fill="currentColor" />
              <circle cx="6.5" cy="12.5" r=".5" fill="currentColor" />
              <path
                d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z" />
            </svg>
          </div>
          <h3 class="text-xl lg:text-2xl font-semibold mb-2" style="color: var(--title-color, #1a1a1a);">Design</h3>
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
            <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="16 18 22 12 16 6" />
              <polyline points="8 6 2 12 8 18" />
            </svg>
          </div>
          <h3 class="text-xl lg:text-2xl font-semibold mb-2" style="color: var(--title-color, #1a1a1a);">Development</h3>
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
            <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
              <path d="m9 12 2 2 4-4" />
            </svg>
          </div>
          <h3 class="text-xl lg:text-2xl font-semibold mb-2" style="color: var(--title-color, #1a1a1a);">QA & Testing</h3>
          <p class="text-sm text-slate-500 leading-relaxed">Rigorous testing to ensure flawless performance and security.
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
            <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z" />
              <path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z" />
              <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0" />
              <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5" />
            </svg>
          </div>
          <h3 class="text-xl lg:text-2xl font-semibold mb-2" style="color: var(--title-color, #1a1a1a);">Launch</h3>
          <p class="text-sm text-slate-500 leading-relaxed">Deploying with precision and monitoring
            performance.</p>
        </div>

      </div>
    </div>
  </section>



@endsection