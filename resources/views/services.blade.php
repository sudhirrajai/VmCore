@extends('layouts.app')

@section('title', 'Services - ' . ($siteSettings['site_name'] ?? 'VM CORE'))

@section('content')

  <!-- Services Header -->
  <section class="container-custom py-20">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
      <h2 class="text-5xl md:text-6xl font-bold tracking-tighter">What We Excel At</h2>
      <p class="text-secondary max-w-xs text-sm uppercase tracking-widest font-bold">
        Our Specialized Services
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
              <h3 class="text-2xl font-bold mb-1">{{ $service->title }}</h3>
              <div class="text-gray-600 mb-3 leading-relaxed line-clamp-2" title="{{ strip_tags($service->description) }}">
                {{ \Illuminate\Support\Str::limit(strip_tags($service->description), 80) }}
              </div>
              <ul class="grid grid-cols-1 gap-y-1">
                {{-- Hardcoded for aesthetic if service features don't exist in DB, else use a relation --}}
                <li class="flex items-center text-sm font-medium">
                  <span class="w-1.5 h-1.5 bg-black rounded-full mr-3"></span>
                  Strategic Planning
                </li>
                <li class="flex items-center text-sm font-medium">
                  <span class="w-1.5 h-1.5 bg-black rounded-full mr-3"></span>
                  Modern Execution
                </li>
              </ul>

              <div
                class="mt-4 flex items-center gap-1.5 text-[13px] font-bold uppercase tracking-wider text-slate-900 group-hover:text-[#4E7CC1] transition-colors">
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
            <h3 class="text-2xl font-bold mb-1">Business Consultancy</h3>
            <p class="text-gray-600 mb-3 leading-relaxed">
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
              class="mt-4 flex items-center gap-1.5 text-[13px] font-bold uppercase tracking-wider text-slate-900 group-hover:text-[#4E7CC1] transition-colors">
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
  <section class="container-custom pt-12 pb-24">
      <div class="border-t border-gray-100 pt-16 mb-16 flex flex-col md:flex-row md:items-end md:justify-between gap-6 animate-on-scroll">
          <div>
              <span class="text-sm font-semibold uppercase tracking-wider" style="color: var(--theme-color, #c5a059);">How We Work</span>
              <h2 class="text-4xl md:text-5xl font-bold tracking-tighter mt-2" style="color: var(--title-color, #1a1a1a);">Our Process</h2>
          </div>
          <p class="text-slate-500 max-w-sm text-sm leading-relaxed">A proven framework that transforms your vision into measurable results, step by step.</p>
      </div>

      <div class="mx-auto" style="max-width: 1100px;">
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
          <div class="group relative animate-on-scroll border border-gray-100 p-4 lg:p-5 transition-all duration-300 hover:shadow-lg hover:z-10 flex-1 min-w-0 process-card" style="--step-color: var(--theme-color, #c5a059);">
              <div class="flex items-start gap-2 mb-2">
                  <span class="text-3xl font-bold leading-none opacity-10 group-hover:opacity-20 transition-opacity" style="color: var(--theme-color, #c5a059); font-family: 'Neuton', serif;">01</span>
              </div>
              <div class="process-icon rounded-lg flex items-center justify-center border-none transition-colors duration-300" style="width: 45px; height: 45px; margin-bottom: 15px; background: color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent); color: var(--theme-color, #c5a059);">
                  <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="11" cy="11" r="8" /><path d="m21 21-4.3-4.3" />
                  </svg>
              </div>
              <h3 class="font-bold mb-1" style="font-size: 1.1rem; color: var(--title-color, #1a1a1a);">Discovery</h3>
              <p class="text-slate-500 leading-relaxed" style="font-size: 0.8rem;">Understanding your goals, audience, and challenges.</p>
          </div>

          {{-- Step 2: Strategy --}}
          <div class="group relative animate-on-scroll delay-100 border border-gray-100 p-4 lg:p-5 transition-all duration-300 hover:shadow-lg hover:z-10 flex-1 min-w-0 process-card">
              <div class="flex items-start gap-2 mb-2">
                  <span class="text-3xl font-bold leading-none opacity-10 group-hover:opacity-20 transition-opacity" style="color: var(--theme-color, #c5a059); font-family: 'Neuton', serif;">02</span>
              </div>
              <div class="process-icon rounded-lg flex items-center justify-center border-none transition-colors duration-300" style="width: 45px; height: 45px; margin-bottom: 15px; background: color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent); color: var(--theme-color, #c5a059);">
                  <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M21.21 15.89A10 10 0 1 1 8 2.83" /><path d="M22 12A10 10 0 0 0 12 2v10z" />
                  </svg>
              </div>
              <h3 class="font-bold mb-1" style="font-size: 1.1rem; color: var(--title-color, #1a1a1a);">Strategy</h3>
              <p class="text-slate-500 leading-relaxed" style="font-size: 0.8rem;">Crafting a data-driven roadmap aligned with your objectives.</p>
          </div>

          {{-- Step 3: Design --}}
          <div class="group relative animate-on-scroll delay-200 border border-gray-100 p-4 lg:p-5 transition-all duration-300 hover:shadow-lg hover:z-10 flex-1 min-w-0 process-card">
              <div class="flex items-start gap-2 mb-2">
                  <span class="text-3xl font-bold leading-none opacity-10 group-hover:opacity-20 transition-opacity" style="color: var(--theme-color, #c5a059); font-family: 'Neuton', serif;">03</span>
              </div>
              <div class="process-icon rounded-lg flex items-center justify-center border-none transition-colors duration-300" style="width: 45px; height: 45px; margin-bottom: 15px; background: color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent); color: var(--theme-color, #c5a059);">
                  <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="13.5" cy="6.5" r=".5" fill="currentColor" /><circle cx="17.5" cy="10.5" r=".5" fill="currentColor" /><circle cx="8.5" cy="7.5" r=".5" fill="currentColor" /><circle cx="6.5" cy="12.5" r=".5" fill="currentColor" />
                      <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z" />
                  </svg>
              </div>
              <h3 class="font-bold mb-1" style="font-size: 1.1rem; color: var(--title-color, #1a1a1a);">Design</h3>
              <p class="text-slate-500 leading-relaxed" style="font-size: 0.8rem;">Creating intuitive interfaces that engage and elevate.</p>
          </div>

          {{-- Step 4: Development --}}
          <div class="group relative animate-on-scroll delay-300 border border-gray-100 p-4 lg:p-5 transition-all duration-300 hover:shadow-lg hover:z-10 flex-1 min-w-0 process-card">
              <div class="flex items-start gap-2 mb-2">
                  <span class="text-3xl font-bold leading-none opacity-10 group-hover:opacity-20 transition-opacity" style="color: var(--theme-color, #c5a059); font-family: 'Neuton', serif;">04</span>
              </div>
              <div class="process-icon rounded-lg flex items-center justify-center border-none transition-colors duration-300" style="width: 45px; height: 45px; margin-bottom: 15px; background: color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent); color: var(--theme-color, #c5a059);">
                  <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="16 18 22 12 16 6" /><polyline points="8 6 2 12 8 18" />
                  </svg>
              </div>
              <h3 class="font-bold mb-1" style="font-size: 1.1rem; color: var(--title-color, #1a1a1a);">Development</h3>
              <p class="text-slate-500 leading-relaxed" style="font-size: 0.8rem;">Building high-performance systems with clean code.</p>
          </div>

          {{-- Step 5: Launch --}}
          <div class="group relative animate-on-scroll delay-400 border border-gray-100 p-4 lg:p-5 transition-all duration-300 hover:shadow-lg hover:z-10 flex-1 min-w-0 process-card">
              <div class="flex items-start gap-2 mb-2">
                  <span class="text-3xl font-bold leading-none opacity-10 group-hover:opacity-20 transition-opacity" style="color: var(--theme-color, #c5a059); font-family: 'Neuton', serif;">05</span>
              </div>
              <div class="process-icon rounded-lg flex items-center justify-center border-none transition-colors duration-300" style="width: 45px; height: 45px; margin-bottom: 15px; background: color-mix(in srgb, var(--theme-color, #c5a059) 10%, transparent); color: var(--theme-color, #c5a059);">
                  <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z" />
                      <path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z" />
                      <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0" /><path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5" />
                  </svg>
              </div>
              <h3 class="font-bold mb-1" style="font-size: 1.1rem; color: var(--title-color, #1a1a1a);">Launch</h3>
              <p class="text-slate-500 leading-relaxed" style="font-size: 0.8rem;">Deploying with precision and monitoring performance.</p>
          </div>

      </div>
      </div>
  </section>



@endsection