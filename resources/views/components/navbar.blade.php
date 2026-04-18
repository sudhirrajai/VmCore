<style>
  /* Sticky Header Styles */
  .header-sticky {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    background: transparent;
    padding-top: 1.25rem !important;
    padding-bottom: 1.25rem !important;
  }

  .header-sticky.scrolled {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(12px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    padding-top: 5px !important;
    padding-bottom: 5px !important;
  }

  .header-sticky.scrolled nav {
    padding-top: 1.25rem !important;
    padding-bottom: 1.25rem !important;
  }

  /* Scroll Progress Bar */
  .scroll-progress-container {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: transparent;
    pointer-events: none;
  }

  .scroll-progress-bar {
    height: 100%;
    width: 0%;
    background: var(--theme-color, #4A76B2);
    transition: width 0.1s linear;
  }

  /* Mobile menu active header fix */
  body.mobile-menu-open .header-sticky {
    z-index: 997;
  }

  /* ── Mobile Menu Styles ── */
  .mobile-menu-overlay {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.5);
    backdrop-filter: blur(4px);
    z-index: 998;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
  }

  .mobile-menu-overlay.active {
    opacity: 1;
    pointer-events: auto;
  }

  .mobile-menu-panel {
    position: fixed;
    top: 0;
    right: 0;
    width: min(85vw, 380px);
    height: 100dvh;
    background: #ffffff;
    z-index: 999;
    transform: translateX(100%);
    transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    box-shadow: -8px 0 30px rgba(0, 0, 0, 0.12);
    overflow-y: auto;
    overscroll-behavior: contain;
  }

  .mobile-menu-panel.active {
    transform: translateX(0);
  }

  .mobile-menu-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.5rem 1.5rem 1rem;
    border-bottom: 1px solid #f1f5f9;
  }

  .mobile-menu-close {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: transparent;
    cursor: pointer;
    transition: all 0.2s ease;
    color: #334155;
  }

  .mobile-menu-close:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
  }

  .mobile-menu-links {
    flex: 1;
    padding: 1rem 0;
    display: flex;
    flex-direction: column;
  }

  .mobile-nav-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.75rem;
    font-size: 1.05rem;
    font-weight: 500;
    color: #334155;
    text-decoration: none;
    transition: all 0.2s ease;
    border-left: 3px solid transparent;
    letter-spacing: 0.02em;
  }

  .mobile-nav-link:hover {
    background: #f8fafc;
    color: #0f172a;
  }

  .mobile-nav-link.active {
    color: var(--theme-color, #4A76B2);
    border-left-color: var(--theme-color, #4A76B2);
    background: color-mix(in srgb, var(--theme-color, #4A76B2) 5%, transparent);
    font-weight: 700;
  }


  .mobile-menu-cta {
    padding: 1.25rem 1.5rem 2rem;
    border-top: 1px solid #f1f5f9;
  }

  .mobile-cta-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    padding: 0.9rem 1.5rem;
    background: var(--theme-color, #4A76B2);
    color: #ffffff;
    font-size: 0.875rem;
    /* text-sm */
    font-weight: 500;
    /* font-medium */
    letter-spacing: 0.12em;
    text-transform: uppercase;
    border-radius: 0.375rem;
    text-decoration: none;
    transition: all 0.2s ease;
    box-shadow: 0 4px 14px color-mix(in srgb, var(--theme-color, #4A76B2) 30%, transparent);
  }

  .mobile-cta-btn:hover {
    filter: brightness(0.92);
    transform: translateY(-1px);
    color: #ffffff;
  }

  .mobile-menu-contact {
    padding: 0 1.5rem 0.5rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }

  .mobile-menu-contact a {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    font-size: 0.85rem;
    color: #64748b;
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .mobile-menu-contact a:hover {
    color: var(--theme-color, #4A76B2);
  }

  .mobile-menu-contact svg {
    width: 15px;
    height: 15px;
    flex-shrink: 0;
  }

  /* Hamburger button */
  .hamburger-btn {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    background: white;
    cursor: pointer;
    gap: 5px;
    transition: all 0.2s ease;
  }

  @media (min-width: 768px) {
    .hamburger-btn {
      display: none !important;
    }
  }

  .hamburger-btn:hover {
    border-color: #cbd5e1;
    background: #f8fafc;
  }

  .hamburger-btn span {
    display: block;
    width: 20px;
    height: 2px;
    background: #334155;
    border-radius: 2px;
    transition: all 0.3s ease;
  }

  /* Lock body scroll when menu is open */
  body.mobile-menu-open {
    overflow: hidden;
  }

  /* Stagger animation for links */
  .mobile-menu-panel.active .mobile-nav-link {
    animation: slideInLink 0.3s ease forwards;
    opacity: 0;
  }

  @keyframes slideInLink {
    from {
      opacity: 0;
      transform: translateX(20px);
    }

    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  .desktop-cta-btn {
    background: var(--theme-color, #4A76B2) !important;
  }

  .desktop-cta-btn:hover {
    filter: brightness(0.92);
    box-shadow: 0 8px 16px color-mix(in srgb, var(--theme-color, #4A76B2) 25%, transparent);
  }
</style>

<header class="header-sticky" id="mainHeader">
  <nav class="flex items-center justify-between py-8 container-custom mx-auto w-full bg-transparent"
    aria-label="Main navigation" role="navigation">
    {{-- Scroll Progress --}}
    <div class="scroll-progress-container">
      <div class="scroll-progress-bar" id="scrollProgress"></div>
    </div>
    {{-- Logo --}}
    <div class="text-2xl font-bold tracking-tighter text-slate-900">
      <a href="{{ route('home') }}" aria-label="{{ $siteSettings['site_name'] ?? 'VM CORE' }} - Home">
        @php
          $logoUrl = !empty($siteSettings['logo']) ? asset($siteSettings['logo']) : '';
        @endphp
        @if($logoUrl)
          <img src="{{ $logoUrl }}" alt="{{ $siteSettings['site_name'] ?? 'VM CORE' }}"
            style="height: 35px; width: auto; object-fit: contain;">
        @else
          {{ $siteSettings['site_name'] ?? 'VM CORE' }}
        @endif
      </a>
    </div>

    {{-- Desktop Navigation --}}
    <div class="hidden md:flex items-center space-x-8 text-base font-medium">
      @if(isset($headerMenu) && $headerMenu->count() > 0)
        @foreach($headerMenu as $item)
          @php
            $url = $item->custom_url ?: ($item->page ? url($item->page->slug) : '#');
            $path = parse_url($url, PHP_URL_PATH);
            $path = $path ? ltrim($path, '/') : '';
            $isActive = request()->is($path) || ($path !== '' && request()->is($path . '/*'));
            if ($path === '' && request()->path() === '/')
              $isActive = true;
          @endphp
          <a href="{{ $url }}" target="{{ $item->target ?? '_self' }}"
            class="transition-all {{ $isActive ? 'border-b-2 border-black pb-1 text-slate-900' : 'text-slate-800 hover:opacity-60 transition-opacity' }}">
            {{ $item->title }}
          </a>
        @endforeach
      @else
        <a href="{{ route('home') }}"
          class="transition-all {{ request()->routeIs('home') ? 'border-b-2 border-black pb-1 text-slate-900' : 'text-slate-800 hover:opacity-60 transition-opacity' }}">Home</a>
        <a href="{{ route('about') }}"
          class="transition-all {{ request()->routeIs('about') ? 'border-b-2 border-black pb-1 text-slate-900' : 'text-slate-800 hover:opacity-60 transition-opacity' }}">About</a>
        <a href="{{ route('services') }}"
          class="transition-all {{ request()->routeIs('services', 'service.detail') ? 'border-b-2 border-black pb-1 text-slate-900' : 'text-slate-800 hover:opacity-60 transition-opacity' }}">Services</a>
        <a href="{{ route('portfolio') }}"
          class="transition-all {{ request()->routeIs('portfolio', 'portfolio.detail') ? 'border-b-2 border-black pb-1 text-slate-900' : 'text-slate-800 hover:opacity-60 transition-opacity' }}">Portfolio</a>
        @if(\App\Models\Setting::get('show_blog_page', 1))
          <a href="{{ route('blog') }}"
            class="transition-all {{ request()->routeIs('blog', 'blog.detail') ? 'border-b-2 border-black pb-1 text-slate-900' : 'text-slate-800 hover:opacity-60 transition-opacity' }}">Blog</a>
        @endif
        <a href="{{ route('faq') }}"
          class="transition-all {{ request()->routeIs('faq') ? 'border-b-2 border-black pb-1 text-slate-900' : 'text-slate-800 hover:opacity-60 transition-opacity' }}">FAQ</a>
      @endif

      <a href="{{ route('contact') }}"
        class="desktop-cta-btn text-white px-6 py-2.5 rounded-sm text-sm font-medium tracking-widest uppercase transition-all duration-300 inline-block hover:-translate-y-0.5">
        {!! setting('navbar_cta_text', 'WORK WITH US') !!}
      </a>
    </div>

    {{-- Mobile Hamburger Button --}}
    <button class="hamburger-btn flex flex-col justify-center items-center md:hidden" id="mobileMenuToggle"
      aria-label="Open navigation menu" aria-expanded="false" aria-controls="mobileMenuPanel">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </nav>
</header>

{{-- Mobile Menu Overlay --}}
<div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

{{-- Mobile Menu Panel --}}
<div class="mobile-menu-panel" id="mobileMenuPanel" role="dialog" aria-modal="true" aria-label="Mobile navigation">

  {{-- Header --}}
  <div class="mobile-menu-header">
    <a href="{{ route('home') }}" aria-label="{{ $siteSettings['site_name'] ?? 'VM CORE' }} - Home">
      @if($logoUrl)
        <img src="{{ $logoUrl }}" alt="{{ $siteSettings['site_name'] ?? 'VM CORE' }}"
          style="height: 28px; width: auto; object-fit: contain;">
      @else
        <span
          class="text-lg font-bold tracking-tighter text-slate-900">{{ $siteSettings['site_name'] ?? 'VM CORE' }}</span>
      @endif
    </a>
    <button class="mobile-menu-close" id="mobileMenuClose" aria-label="Close navigation menu">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 6 6 18" />
        <path d="m6 6 12 12" />
      </svg>
    </button>
  </div>

  {{-- Navigation Links --}}
  <div class="mobile-menu-links">
    @if(isset($headerMenu) && $headerMenu->count() > 0)
      @foreach($headerMenu as $index => $item)
        @php
          $url = $item->custom_url ?: ($item->page ? url($item->page->slug) : '#');
          $path = parse_url($url, PHP_URL_PATH);
          $path = $path ? ltrim($path, '/') : '';
          $isActive = request()->is($path) || ($path !== '' && request()->is($path . '/*'));
          if ($path === '' && request()->path() === '/')
            $isActive = true;
          $delay = 0.05 * ($index + 1);
        @endphp
        <a href="{{ $url }}" target="{{ $item->target ?? '_self' }}" class="mobile-nav-link {{ $isActive ? 'active' : '' }}"
          style="animation-delay: {{ $delay }}s;">
          {{ $item->title }}
        </a>
      @endforeach
    @else
      <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
        style="animation-delay: 0.05s;">
        Home
      </a>
      <a href="{{ route('about') }}" class="mobile-nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
        style="animation-delay: 0.1s;">
        About
      </a>
      <a href="{{ route('services') }}"
        class="mobile-nav-link {{ request()->routeIs('services', 'service.detail') ? 'active' : '' }}"
        style="animation-delay: 0.15s;">
        Services
      </a>
      <a href="{{ route('portfolio') }}"
        class="mobile-nav-link {{ request()->routeIs('portfolio', 'portfolio.detail') ? 'active' : '' }}"
        style="animation-delay: 0.2s;">
        Portfolio
      </a>
      @if(\App\Models\Setting::get('show_blog_page', 1))
        <a href="{{ route('blog') }}"
          class="mobile-nav-link {{ request()->routeIs('blog', 'blog.detail') ? 'active' : '' }}"
          style="animation-delay: 0.25s;">
          Blog
        </a>
      @endif
      <a href="{{ route('faq') }}" class="mobile-nav-link {{ request()->routeIs('faq') ? 'active' : '' }}"
        style="animation-delay: 0.3s;">
        FAQ
      </a>
      <a href="{{ route('contact') }}" class="mobile-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
        style="animation-delay: 0.35s;">
        Contact
      </a>
    @endif
  </div>

  {{-- Contact Info --}}
  <div class="mobile-menu-contact">
    @if(!empty($siteSettings['site_phone']))
      <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['site_phone']) }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <path
            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
        </svg>
        {{ $siteSettings['site_phone'] }}
      </a>
    @endif
    @if(!empty($siteSettings['site_email']))
      <a href="mailto:{{ $siteSettings['site_email'] }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <rect width="20" height="16" x="2" y="4" rx="2" />
          <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
        </svg>
        {{ $siteSettings['site_email'] }}
      </a>
    @endif
  </div>

  {{-- CTA Button --}}
  <div class="mobile-menu-cta">
    <a href="{{ route('contact') }}" class="mobile-cta-btn">
      {!! setting('navbar_cta_text', 'WORK WITH US') !!}
      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14" />
        <path d="m12 5 7 7-7 7" />
      </svg>
    </a>
  </div>
</div>

<script>
  (function () {
    const toggle = document.getElementById('mobileMenuToggle');
    const overlay = document.getElementById('mobileMenuOverlay');
    const panel = document.getElementById('mobileMenuPanel');
    const closeBtn = document.getElementById('mobileMenuClose');

    function openMenu() {
      panel.classList.add('active');
      overlay.classList.add('active');
      document.body.classList.add('mobile-menu-open');
      toggle.setAttribute('aria-expanded', 'true');
      // Focus the close button for accessibility
      setTimeout(() => closeBtn.focus(), 350);
    }

    function closeMenu() {
      panel.classList.remove('active');
      overlay.classList.remove('active');
      document.body.classList.remove('mobile-menu-open');
      toggle.setAttribute('aria-expanded', 'false');
      toggle.focus();
    }

    toggle.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', closeMenu);
    overlay.addEventListener('click', closeMenu);

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && panel.classList.contains('active')) {
        closeMenu();
      }
    });

    // Close menu on navigation link click (for SPA-like feel)
    panel.querySelectorAll('.mobile-nav-link').forEach(function (link) {
      link.addEventListener('click', function () {
        closeMenu();
      });
    });

    // ── Scroll Listener for Sticky Header & Progress Bar ──
    const header = document.getElementById('mainHeader');
    const progressBar = document.getElementById('scrollProgress');

    window.addEventListener('scroll', () => {
      // Sticky Header Logic
      if (window.scrollY > 20) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }

      // Scroll Progress Logic
      const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
      const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      const scrolled = (winScroll / height) * 100;
      if (progressBar) {
        progressBar.style.width = scrolled + "%";
      }
    }, { passive: true });
  })();
</script>