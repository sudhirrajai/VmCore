<nav class="flex items-center justify-between px-6 py-6 max-w-[1440px] mx-auto w-full bg-transparent">
  <div class="text-2xl font-bold tracking-tighter text-slate-900">
    <a href="{{ route('home') }}">
      @php
          $logoUrl = !empty($siteSettings['logo']) ? asset($siteSettings['logo']) : '';
      @endphp
      @if($logoUrl)
          <img src="{{ $logoUrl }}" alt="{{ $siteSettings['site_name'] ?? 'VM CORE' }}" style="height: 35px; width: auto; object-fit: contain;">
      @else
          {{ $siteSettings['site_name'] ?? 'VM CORE' }}
      @endif
    </a>
  </div>
  
  <div class="hidden md:flex items-center space-x-8 text-sm font-medium">
    <a href="{{ route('home') }}" class="transition-all {{ request()->routeIs('home') ? 'border-b-2 border-black pb-1 text-slate-900' : 'text-slate-800 hover:opacity-60 transition-opacity' }}">Home</a>
    <a href="{{ route('about') }}" class="transition-all {{ request()->routeIs('about') ? 'border-b-2 border-black pb-1 text-slate-900' : 'text-slate-800 hover:opacity-60 transition-opacity' }}">About</a>
    <a href="{{ route('services') }}" class="transition-all {{ request()->routeIs('services') ? 'border-b-2 border-black pb-1 text-slate-900' : 'text-slate-800 hover:opacity-60 transition-opacity' }}">Services</a>
    <a href="{{ route('portfolio') }}" class="transition-all {{ request()->routeIs('portfolio') ? 'border-b-2 border-black pb-1 text-slate-900' : 'text-slate-800 hover:opacity-60 transition-opacity' }}">Portfolio</a>
    <a href="{{ route('faq') }}" class="transition-all {{ request()->routeIs('faq') ? 'border-b-2 border-black pb-1 text-slate-900' : 'text-slate-800 hover:opacity-60 transition-opacity' }}">FAQ</a>
    
    <a href="{{ route('contact') }}" class="bg-[#4A76B2] text-white px-6 py-2.5 rounded-sm text-xs font-bold tracking-widest uppercase hover:bg-opacity-90 transition-all inline-block">
      WORK WITH US
    </a>
  </div>
</nav>
