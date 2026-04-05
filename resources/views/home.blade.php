@extends('layouts.app')

@section('title', 'Home - ' . ($siteSettings['site_name'] ?? 'VM CORE'))

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

    /* Home page hero H1 — slightly larger than global 3rem */
    .home-hero h1 {
      font-size: 4.5rem !important;
      /* ~72px */
    }
  </style>
@endpush

@section('content')

  <!-- Hero Section -->
  <section class="pt-0 pb-12 home-hero">
    <div class="container-custom grid md:grid-cols-2 gap-12 items-center">
      <div class="animate-fade-in-left">
        <h1 class="text-5xl md:text-7xl font-bold leading-[1.1] text-slate-900 mb-6">
          @if(isset($hero) && $hero)
            {!! $hero->title !!}
          @else
            WE MAKE <br />
            CREATIVE THINGS <br />
            EVERYDAY
          @endif
        </h1>
        <p class="text-xl tracking-wide text-slate-600 mb-8 max-w-md leading-relaxed">
          @if(isset($hero) && $hero)
            {!! $hero->description !!}
          @else
            We are a digital agency that helps build immersive and engaging user experiences that drive results.
          @endif
        </p>
        <a href="{{ route('portfolio') }}"
          class="inline-flex bg-[#4E7CC1] text-white px-8 py-4 rounded-md font-semibold items-center gap-2 hover:bg-[#3d66a3] transition-all shadow-md">
          VIEW OUR WORKS
        </a>
      </div>
      <div class="relative animate-fade-in-up delay-200">
        <img
          src="{{ isset($hero) && $hero->image ? asset($hero->image) : 'https://picsum.photos/seed/vmcore-meeting/800/600' }}"
          alt="Team Meeting" class="rounded-3xl shadow-2xl w-full object-cover aspect-[4/3]" />
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section id="services" class="py-12">
    <div class="container-custom">
      <div class="mb-14">
        <span class="text-[15px] font-medium text-secondary mb-3 block">Services</span>
        <h2 class="text-[44px] font-bold text-slate-900 leading-tight tracking-tight">What We Can Do for Our Clients</h2>
      </div>
      <div class="grid md:grid-cols-2 gap-8">
        @if(isset($services) && $services->count() > 0)
          @foreach($services as $index => $service)
            <a href="{{ route('service.detail', $service->slug ?? '') }}"
              class="bg-card p-10 rounded-2xl border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex gap-8 items-start group cursor-pointer hover:-translate-y-1 transition-transform animate-on-scroll">
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
                <h3 class="text-[22px] font-bold text-slate-900 mb-3">{{ $service->title }}</h3>
                <div class="text-slate-500 tracking-wide text-[1.15rem] mb-5 leading-relaxed max-w-[340px] line-clamp-2">
                  {{ \Illuminate\Support\Str::limit(strip_tags($service->description), 80) }}
                </div>
                <div
                  class="flex items-center gap-1.5 text-[13px] font-bold uppercase tracking-wider text-slate-900 group-hover:text-[#4E7CC1] transition-colors">
                  VIEW DETAILS
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
            class="bg-card p-10 rounded-2xl border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex gap-8 items-start group cursor-pointer">
            <p class="text-slate-500 tracking-wide text-[1.15rem] mb-5 leading-relaxed max-w-[340px]">No services found.</p>
          </div>
        @endif
      </div>
    </div>
  </section>

  <!-- Projects Section -->
  <section id="portfolio" class="py-24">
    <div class="container-custom">
      <div class="mb-14">
        <span class="text-sm font-semibold text-secondary uppercase tracking-wider">Projects</span>
        <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mt-2 uppercase tracking-tight leading-tight">Discover Our
          Selected Projects</h2>
      </div>
      <div class="grid md:grid-cols-3 gap-12">
        @if(isset($projects) && $projects->count() > 0)
          @foreach($projects as $project)
            <div class="proj-card animate-on-scroll">
              <a href="{{ route('portfolio.detail', $project->slug ?? '') }}" class="block">
                <div class="relative aspect-[3/4] overflow-hidden rounded-2xl bg-slate-100 shadow-sm">
                  <img
                    src="{{ $project->image ? asset($project->image) : 'https://picsum.photos/seed/project-' . $project->id . '/600/800' }}"
                    alt="{{ $project->title }}" class="proj-img w-full h-full object-cover" />
                  {{-- Hover Overlay --}}
                  <div class="proj-overlay">
                    <span class="proj-btn">View Project</span>
                  </div>
                </div>
              </a>
              <div class="mt-6">
                <h3 class="text-xl font-bold text-slate-900 mb-1 leading-tight">{{ $project->title }}</h3>
                <p class="text-[1.1rem] tracking-wide text-slate-500">{{ $project->categories->first()->name ?? 'Portfolio' }}
                </p>
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