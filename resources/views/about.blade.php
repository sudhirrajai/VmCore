@extends('layouts.app')

@section('title', setting('about_meta_title', 'About Us - ' . ($siteSettings['site_name'] ?? 'VM CORE')))
@section('meta_description', setting('about_meta_description', 'Learn about our story, leadership team, and the core values that drive our digital agency forward.'))
@section('meta_keywords', setting('about_meta_keywords', 'about us, digital agency, team, creative studio, company profile'))
@section('canonical', route('about'))

@push('structured_data')
  <script type="application/ld+json">
                {
                    "@@context": "https://schema.org",
                    "@@type": "AboutPage",
                    "name": "About {{ addslashes($siteSettings['site_name'] ?? 'VMCore') }}",
                    "description": "{{ addslashes(setting('about_meta_description', 'Learn about our story, leadership team, and the core values that drive our digital agency forward.')) }}",
                    "url": "{{ route('about') }}",
                    "mainEntity": {
                        "@@type": "Organization",
                        "name": "{{ addslashes($siteSettings['site_name'] ?? 'VMCore') }}",
                        "url": "{{ url('/') }}"
                    }
                }
                </script>
  <script type="application/ld+json">
                {
                    "@@context": "https://schema.org",
                    "@@type": "BreadcrumbList",
                    "itemListElement": [
                        {
                            "@@type": "ListItem",
                            "position": 1,
                            "name": "Home",
                            "item": "{{ url('/') }}"
                        },
                        {
                            "@@type": "ListItem",
                            "position": 2,
                            "name": "About Us",
                            "item": "{{ route('about') }}"
                        }
                    ]
                }
                </script>
@endpush

@push('styles')
  <style>
    .about-card {
      transition: all 0.3s ease;
    }

    .about-card:hover {
      border-color: var(--theme-color, #c5a059) !important;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08) !important;
    }

    .about-card:hover .about-icon {
      background: var(--theme-color, #c5a059) !important;
      color: #ffffff !important;
    }

    .about-icon {
      transition: background 0.3s ease, color 0.3s ease;
      color: var(--theme-color, #c5a059);
      background: var(--icon-bg-color) !important;
    }
  </style>
@endpush

@section('content')

  <!-- Page Header -->
  <section class="container-custom pt-20 pb-12 px-8 text-center max-w-4xl mx-auto animate-fade-in-up">
    <h1 class="text-5xl lg:text-7xl font-bold leading-tight mb-6 text-slate-900">
      {!! setting('about_hero_title', 'Our Story') !!}
    </h1>
    <p class="text-base leading-relaxed text-slate-500 max-w-2xl mx-auto">
      {!! setting('about_hero_description', 'We are a digital agency dedicated to driving digital transformation, building immersive experiences that empower businesses and connect with audiences. Our passion is innovation, and our mission is your success.') !!}
    </p>
  </section>

  <!-- Hero Image -->
  <section class="container-custom pb-20" aria-label="About Hero Image">
    <div
      class="relative aspect-[16/9] lg:aspect-[21/9] rounded-2xl overflow-hidden shadow-2xl animate-fade-in-up delay-200 w-full">
      <img
        src="{{ setting('about_hero_image') ? asset(setting('about_hero_image')) : 'https://picsum.photos/seed/agency-team-office/1200/900' }}"
        alt="{{ setting('about_hero_image_alt', ($siteSettings['site_name'] ?? 'VMCore') . ' - Our Team') }}"
        class="object-cover w-full h-full grayscale-[0.2] hover:scale-105 transition-transform duration-700"
        loading="eager" />
    </div>
  </section>

  <!-- Leadership Section -->
  {{-- <section class="container-custom py-12" aria-label="Leadership Team">
    <div class="mb-12">
      <span class="text-sm font-medium text-secondary uppercase tracking-widest">{!! setting('about_leadership_label',
        'Our Leadership') !!}</span>
      <h2 class="text-2xl lg:text-4xl font-semibold leading-tight mt-2 mb-6 text-slate-900">{!!
        setting('about_leadership_heading', 'Our Leadership') !!}</h2>
    </div>
    <div class="grid md:grid-cols-3 gap-8">
      @if(isset($team) && $team->count() > 0)
      @foreach($team as $member)
      <div class="group animate-on-scroll">
        <div class="aspect-[3/4] rounded-xl overflow-hidden mb-6 bg-gray-100 relative">
          <img src="{{ asset($member->image) }}" alt="{{ $member->name }} - {{ $member->designation ?? $member->role }}"
            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500"
            loading="lazy" />
        </div>
        <h3 class="text-xl lg:text-2xl font-semibold mb-2 text-slate-900">{{ $member->name }}</h3>
        <p class="text-sm text-slate-500">{{ $member->designation ?? $member->role }}</p>
      </div>
      @endforeach
      @else

      <div class="group animate-on-scroll">
        <div class="aspect-[3/4] rounded-xl overflow-hidden mb-6 bg-gray-100">
          <img src="https://picsum.photos/seed/alex-chen-portrait/600/800" alt="Alex Chen - CEO & Founder"
            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500"
            loading="lazy" />
        </div>
        <h3 class="text-xl lg:text-2xl font-semibold mb-2 text-slate-900">Alex Chen</h3>
        <p class="text-sm text-slate-500">CEO & Founder</p>
      </div>
      <div class="group animate-on-scroll delay-100">
        <div class="aspect-[3/4] rounded-xl overflow-hidden mb-6 bg-gray-100">
          <img src="https://picsum.photos/seed/sarah-johnson-portrait/600/800" alt="Sarah Johnson - Head of Strategy"
            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500"
            loading="lazy" />
        </div>
        <h3 class="text-xl lg:text-2xl font-semibold mb-2 text-slate-900">Sarah Johnson</h3>
        <p class="text-sm text-slate-500">Head of Strategy</p>
      </div>
      <div class="group animate-on-scroll delay-200">
        <div class="aspect-[3/4] rounded-xl overflow-hidden mb-6 bg-gray-100">
          <img src="https://picsum.photos/seed/david-lee-portrait/600/800" alt="David Lee - Creative Director"
            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500"
            loading="lazy" />
        </div>
        <h3 class="text-xl lg:text-2xl font-semibold mb-2 text-slate-900">David Lee</h3>
        <p class="text-sm text-slate-500">Creative Director</p>
      </div>
      @endif
    </div>
  </section> --}}

  <!-- Core Values Section -->
  <section class="container-custom py-12" aria-label="Core Values">
    <div class="mb-12">
      <span
        class="text-sm font-medium text-secondary uppercase tracking-widest">{!! setting('about_values_label', 'Core Values') !!}</span>
      <h2 class="text-2xl lg:text-4xl font-semibold leading-tight mt-2 mb-6 text-slate-900">
        {!! setting('about_values_heading', 'Core Values') !!}
      </h2>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
      <div class="about-card bg-card p-10 rounded-xl shadow-sm border border-gray-100 animate-on-scroll">
        <div class="about-icon w-16 h-16 rounded-xl flex items-center justify-center mb-8">
          <svg class="w-8 h-8 stroke-[1.5]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
            <path
              d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.9 1.2 1.5 1.5 2.5" />
            <path d="M9 18h6" />
            <path d="M10 22h4" />
          </svg>
        </div>
        <h3 class="text-xl lg:text-2xl font-semibold mb-4 text-slate-900">
          {!! setting('about_value_1_title', 'Innovation') !!}
        </h3>
        <p class="text-base leading-relaxed text-slate-500">
          {!! setting('about_value_1_description', 'Pushing boundaries with creative solutions and cutting-edge technology to deliver exceptional results.') !!}
        </p>
      </div>

      <div class="about-card bg-card p-10 rounded-xl shadow-sm border border-gray-100 animate-on-scroll delay-100">
        <div class="about-icon w-16 h-16 rounded-xl flex items-center justify-center mb-8">
          <svg class="w-8 h-8 stroke-[1.5]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
            <path d="m11 17 2 2a1 1 0 1 0 3-3" />
            <path
              d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4" />
            <path d="m21 3 1 11h-2" />
            <path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3" />
          </svg>
        </div>
        <h3 class="text-xl lg:text-2xl font-semibold mb-4 text-slate-900">
          {!! setting('about_value_2_title', 'Integrity') !!}
        </h3>
        <p class="text-base leading-relaxed text-slate-500">
          {!! setting('about_value_2_description', 'Building trust through transparent communication, honest partnerships, and delivering on our promises.') !!}
        </p>
      </div>

      <div class="about-card bg-card p-10 rounded-xl shadow-sm border border-gray-100 animate-on-scroll delay-200">
        <div class="about-icon w-16 h-16 rounded-xl flex items-center justify-center mb-8">
          <svg class="w-8 h-8 stroke-[1.5]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <path d="m16 12-4-4-4 4" />
            <path d="M12 16V8" />
          </svg>
        </div>
        <h3 class="text-xl lg:text-2xl font-semibold mb-4 text-slate-900">{!! setting('about_value_3_title', 'Impact') !!}
        </h3>
        <p class="text-base leading-relaxed text-slate-500">
          {!! setting('about_value_3_description', 'Creating measurable results that drive growth and make a meaningful difference for your business.') !!}
        </p>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="container-custom py-12 grid grid-cols-1 md:grid-cols-3 gap-12 text-center"
    aria-label="Company Statistics">
    <div class="animate-on-scroll">
      <div class="text-4xl lg:text-6xl font-bold mb-4">{!! setting('about_stat_1_value', '50+') !!}</div>
      <div class="text-base font-medium text-slate-500">{!! setting('about_stat_1_label', 'Projects Delivered') !!}</div>
    </div>
    <div class="animate-on-scroll delay-100">
      <div class="text-4xl lg:text-6xl font-bold mb-4">{!! setting('about_stat_2_value', '5+') !!}</div>
      <div class="text-base font-medium text-slate-500">{!! setting('about_stat_2_label', 'Years of Experience') !!}</div>
    </div>
    <div class="animate-on-scroll delay-200">
      <div class="text-4xl lg:text-6xl font-bold mb-4">{!! setting('about_stat_3_value', '98%') !!}</div>
      <div class="text-base font-medium text-slate-500">{!! setting('about_stat_3_label', 'Client Satisfaction') !!}</div>
    </div>
  </section>



@endsection