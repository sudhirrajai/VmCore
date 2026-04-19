@extends('layouts.app')

@section('title', setting('services_meta_title', 'Services - ' . ($siteSettings['site_name'] ?? 'VM CORE')))
@section('meta_description', setting('services_meta_description', 'Explore our range of professional services including branding, web design, development, and digital strategy.'))
@section('meta_keywords', setting('services_meta_keywords', 'services, branding, web design, web development, digital strategy, creative agency'))
@section('canonical', route('services'))
@push('styles')
  <style>
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
  {!! setting('services_page_faq_schema') !!}
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
                @if(Str::startsWith($service->icon, 'fa'))
                  <i
                    class="{{ $service->icon }} text-3xl w-8 h-8 object-contain filter group-hover:brightness-0 group-hover:invert transition-colors"></i>
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
                {!! setting('services_link_text', 'VIEW DETAILS') !!}
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
          <svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.3-4.3" />
          </svg>
        </div>
        <h4>{!! setting('process_step_1_title', 'Discovery') !!}</h4>
        <p>{!! setting('process_step_1_description', 'Understanding your goals, audience, and challenges.') !!}</p>
      </div>

      {{-- Step 2 --}}
      <div class="sd-step animate-on-scroll delay-100">
        <div class="sd-step-num">Step 02</div>
        <div class="sd-step-icon">
          <svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21.21 15.89A10 10 0 1 1 8 2.83" />
            <path d="M22 12A10 10 0 0 0 12 2v10z" />
          </svg>
        </div>
        <h4>{!! setting('process_step_2_title', 'Strategy') !!}</h4>
        <p>{!! setting('process_step_2_description', 'Crafting a data-driven roadmap aligned with your objectives.') !!}
        </p>
      </div>

      {{-- Step 3 --}}
      <div class="sd-step animate-on-scroll delay-200">
        <div class="sd-step-num">Step 03</div>
        <div class="sd-step-icon">
          <svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="13.5" cy="6.5" r=".5" fill="currentColor" />
            <circle cx="17.5" cy="10.5" r=".5" fill="currentColor" />
            <circle cx="8.5" cy="7.5" r=".5" fill="currentColor" />
            <circle cx="6.5" cy="12.5" r=".5" fill="currentColor" />
            <path
              d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z" />
          </svg>
        </div>
        <h4>{!! setting('process_step_3_title', 'Design') !!}</h4>
        <p>{!! setting('process_step_3_description', 'Creating intuitive interfaces that engage and elevate.') !!}</p>
      </div>

      {{-- Step 4 --}}
      <div class="sd-step animate-on-scroll delay-300">
        <div class="sd-step-num">Step 04</div>
        <div class="sd-step-icon">
          <svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="16 18 22 12 16 6" />
            <polyline points="8 6 2 12 8 18" />
          </svg>
        </div>
        <h4>{!! setting('process_step_4_title', 'Development') !!}</h4>
        <p>{!! setting('process_step_4_description', 'Building high-performance systems with clean code.') !!}</p>
      </div>

      {{-- Step 5 --}}
      <div class="sd-step animate-on-scroll delay-[350ms]">
        <div class="sd-step-num">Step 05</div>
        <div class="sd-step-icon">
          <svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
            <path d="m9 12 2 2 4-4" />
          </svg>
        </div>
        <h4>{!! setting('process_step_5_title', 'QA & Testing') !!}</h4>
        <p>{!! setting('process_step_5_description', 'Rigorous testing to ensure flawless performance and security.') !!}
        </p>
      </div>

      {{-- Step 6 --}}
      <div class="sd-step animate-on-scroll delay-400">
        <div class="sd-step-num">Step 06</div>
        <div class="sd-step-icon">
          <svg width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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