@extends('layouts.app')

@section('title', 'About Us - ' . ($siteSettings['site_name'] ?? 'VM CORE'))

@push('styles')
<style>
    .about-card {
        transition: all 0.3s ease;
    }
    .about-card:hover {
        border-color: var(--theme-color, #c5a059) !important;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08) !important;
    }
    .about-card:hover .about-icon {
        background: var(--theme-color, #c5a059) !important;
        color: #ffffff !important;
    }
    .about-icon {
        transition: background 0.3s ease, color 0.3s ease;
        color: var(--theme-color, #c5a059);
        background: color-mix(in srgb, var(--theme-color, #c5a059) 12%, transparent);
    }
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="container-custom pb-12 pt-0 grid md:grid-cols-2 gap-12 items-center">
  <div class="animate-fade-in-left">
    <h1 class="text-6xl md:text-8xl font-bold tracking-tighter mb-8">Our Story</h1>
    <p class="text-lg text-gray-700 leading-relaxed max-w-lg">
      We are a digital agency dedicated to driving digital transformation, building immersive experiences that empower businesses and connect with audiences. Our passion is innovation, and our mission is your success.
    </p>
  </div>
  <div class="relative aspect-[4/3] rounded-2xl overflow-hidden shadow-2xl animate-fade-in-up delay-200">
    <img 
      src="https://picsum.photos/seed/agency-team-office/1200/900" 
      alt="Team working together" 
      class="object-cover w-full h-full grayscale-[0.2] hover:scale-105 transition-transform duration-700"
    />
  </div>
</section>

<!-- Leadership Section -->
<section class="container-custom py-12">
  <div class="mb-12">
    <span class="text-sm font-medium text-secondary uppercase tracking-widest">Our Leadership</span>
    <h2 class="text-5xl font-bold tracking-tighter mt-2">Our Leadership</h2>
  </div>
  <div class="grid md:grid-cols-3 gap-8">
    @if(isset($team) && $team->count() > 0)
        @foreach($team as $member)
        <div class="group animate-on-scroll">
          <div class="aspect-[3/4] rounded-xl overflow-hidden mb-6 bg-gray-100 relative">
            <img 
              src="{{ asset($member->image) }}" 
              alt="{{ $member->name }}" 
              class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500"
            />
          </div>
          <h3 class="text-2xl font-bold tracking-tight">{{ $member->name }}</h3>
          <p class="text-gray-500 text-sm mt-1">{{ $member->designation ?? $member->role }}</p>
        </div>
        @endforeach
    @else
        {{-- Static Fallbacks --}}
        <div class="group animate-on-scroll">
          <div class="aspect-[3/4] rounded-xl overflow-hidden mb-6 bg-gray-100">
            <img src="https://picsum.photos/seed/alex-chen-portrait/600/800" alt="Alex Chen" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" />
          </div>
          <h3 class="text-2xl font-bold tracking-tight">Alex Chen</h3>
          <p class="text-gray-500 text-sm mt-1">CEO & Founder</p>
        </div>
        <div class="group animate-on-scroll delay-100">
          <div class="aspect-[3/4] rounded-xl overflow-hidden mb-6 bg-gray-100">
            <img src="https://picsum.photos/seed/sarah-johnson-portrait/600/800" alt="Sarah Johnson" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" />
          </div>
          <h3 class="text-2xl font-bold tracking-tight">Sarah Johnson</h3>
          <p class="text-gray-500 text-sm mt-1">Head of Strategy</p>
        </div>
        <div class="group animate-on-scroll delay-200">
          <div class="aspect-[3/4] rounded-xl overflow-hidden mb-6 bg-gray-100">
            <img src="https://picsum.photos/seed/david-lee-portrait/600/800" alt="David Lee" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" />
          </div>
          <h3 class="text-2xl font-bold tracking-tight">David Lee</h3>
          <p class="text-gray-500 text-sm mt-1">Creative Director</p>
        </div>
    @endif
  </div>
</section>

<!-- Core Values Section -->
<section class="container-custom py-12">
  <div class="mb-12">
    <span class="text-sm font-medium text-secondary uppercase tracking-widest">Core Values</span>
    <h2 class="text-5xl font-bold tracking-tighter mt-2">Core Values</h2>
  </div>
  <div class="grid md:grid-cols-3 gap-6">
    <div class="about-card bg-card p-10 rounded-xl shadow-sm border border-gray-100 animate-on-scroll">
      <div class="about-icon w-16 h-16 rounded-xl flex items-center justify-center mb-8">
        <svg class="w-8 h-8 stroke-[1.5]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.9 1.2 1.5 1.5 2.5"/><path d="M9 18h6"/><path d="M10 22h4"/></svg>
      </div>
      <h3 class="text-2xl font-bold tracking-tight mb-4">Innovation</h3>
      <p class="text-gray-500 text-sm leading-relaxed">Innovation, innovation experiences and materials for new horizons.</p>
    </div>
    
    <div class="about-card bg-card p-10 rounded-xl shadow-sm border border-gray-100 animate-on-scroll delay-100">
      <div class="about-icon w-16 h-16 rounded-xl flex items-center justify-center mb-8">
        <svg class="w-8 h-8 stroke-[1.5]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="m11 17 2 2a1 1 0 1 0 3-3"/><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"/><path d="m21 3 1 11h-2"/><path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"/></svg>
      </div>
      <h3 class="text-2xl font-bold tracking-tight mb-4">Integrity</h3>
      <p class="text-gray-500 text-sm leading-relaxed">Integrity consulting in maturity and strategic in technology.</p>
    </div>
    
    <div class="about-card bg-card p-10 rounded-xl shadow-sm border border-gray-100 animate-on-scroll delay-200">
      <div class="about-icon w-16 h-16 rounded-xl flex items-center justify-center mb-8">
        <svg class="w-8 h-8 stroke-[1.5]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m16 12-4-4-4 4"/><path d="M12 16V8"/></svg>
      </div>
      <h3 class="text-2xl font-bold tracking-tight mb-4">Impact</h3>
      <p class="text-gray-500 text-sm leading-relaxed">Impact consider that on chat radiant and empower the reflection.</p>
    </div>
  </div>
</section>

<!-- Stats Section -->
<section class="container-custom py-12 grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
  <div class="animate-on-scroll">
    <div class="text-7xl font-bold tracking-tighter mb-2">50+</div>
    <div class="text-lg font-medium text-gray-600">Projects Delivered</div>
  </div>
  <div class="animate-on-scroll delay-100">
    <div class="text-7xl font-bold tracking-tighter mb-2">5+</div>
    <div class="text-lg font-medium text-gray-600">Years of Experience</div>
  </div>
  <div class="animate-on-scroll delay-200">
    <div class="text-7xl font-bold tracking-tighter mb-2">98%</div>
    <div class="text-lg font-medium text-gray-600">Client Satisfaction</div>
  </div>
</section>



@endsection