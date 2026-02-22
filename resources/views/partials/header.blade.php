<!--==============================
    Header Area
==============================-->
@if (request()->is('/'))
    <header class="nav-header header-layout2">
@else
        <header class="nav-header header-layout3 bg-white">
    @endif
        <div class="sticky-wrapper">
            <!-- Main Menu Area -->
            <div class="menu-area">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="header-logo">
                                @if (request()->is('/'))
                                    <a href="{{ route('home') }}"><img
                                            src="{{ !empty($siteSettings['logo_white']) ? asset($siteSettings['logo_white']) : asset('assets/img/logo-white-sm.svg') }}"
                                            alt="{{ $siteSettings['site_name'] ?? 'VMCore' }}"></a>
                                @else
                                    <a href="{{ route('home') }}"><img
                                            src="{{ !empty($siteSettings['logo']) ? asset($siteSettings['logo']) : asset('assets/img/logo.svg') }}"
                                            alt="{{ $siteSettings['site_name'] ?? 'VMCore' }}"></a>
                                @endif
                            </div>
                        </div>
                        <div class="col-auto ms-auto">
                            <nav class="main-menu d-none d-lg-inline-block">
                                <ul>
                                    <li class="{{ request()->is('/') ? 'active' : '' }}">
                                        <a href="{{ route('home') }}">
                                            <span class="link-effect">
                                                <span class="effect-1">HOME</span>
                                                <span class="effect-1">HOME</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('about') ? 'active' : '' }}">
                                        <a href="{{ route('about') }}">
                                            <span class="link-effect">
                                                <span class="effect-1">ABOUT</span>
                                                <span class="effect-1">ABOUT</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('services*') ? 'active' : '' }}">
                                        <a href="{{ route('services') }}">
                                            <span class="link-effect">
                                                <span class="effect-1">SERVICES</span>
                                                <span class="effect-1">SERVICES</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('portfolio*') ? 'active' : '' }}">
                                        <a href="{{ route('portfolio') }}">
                                            <span class="link-effect">
                                                <span class="effect-1">PORTFOLIO</span>
                                                <span class="effect-1">PORTFOLIO</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('blog*') ? 'active' : '' }}">
                                        <a href="{{ route('blog') }}">
                                            <span class="link-effect">
                                                <span class="effect-1">BLOG</span>
                                                <span class="effect-1">BLOG</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('contact') ? 'active' : '' }}">
                                        <a href="{{ route('contact') }}">
                                            <span class="link-effect">
                                                <span class="effect-1">CONTACT</span>
                                                <span class="effect-1">CONTACT</span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="navbar-right d-inline-flex d-lg-none">
                                <button type="button" class="menu-toggle sidebar-btn">
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <span class="line"></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <div class="header-button">
                                <a href="{{ route('contact') }}" class="btn style2">
                                    <span class="link-effect">
                                        <span class="effect-1">WORKS WITH US</span>
                                        <span class="effect-1">WORKS WITH US</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>