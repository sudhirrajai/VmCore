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
                                @php
                                    $logoWhiteUrl = !empty($siteSettings['logo_white']) ? asset($siteSettings['logo_white']) : asset('assets/img/logo-white-sm.svg');
                                    $logoUrl = !empty($siteSettings['logo']) ? asset($siteSettings['logo']) : asset('assets/img/logo.svg');
                                @endphp
                                @if (request()->is('/'))
                                    <a href="{{ route('home') }}"><img src="{{ $logoWhiteUrl }}"
                                            alt="{{ $siteSettings['site_name'] ?? 'VMCore' }}"
                                            style="height: 45px; width: auto; object-fit: contain;"></a>
                                @else
                                    <a href="{{ route('home') }}"><img src="{{ $logoUrl }}"
                                            alt="{{ $siteSettings['site_name'] ?? 'VMCore' }}"
                                            style="height: 45px; width: auto; object-fit: contain;"></a>
                                @endif
                            </div>
                        </div>
                        <div class="col-auto ms-auto">
                            <nav class="main-menu d-none d-lg-inline-block">
                                <ul>
                                    @if(isset($headerMenu) && $headerMenu->count() > 0)
                                        @foreach($headerMenu as $item)
                                            <x-menu-item :item="$item" />
                                        @endforeach
                                    @else
                                        <!-- Fallback if no menu created yet -->
                                        <li class="active"><a href="{{ route('home') }}">Home</a></li>
                                        @if(\App\Models\Setting::get('show_about_page', 1))
                                            <li><a href="{{ route('about') }}">About</a></li>
                                        @endif
                                        @if(\App\Models\Setting::get('show_services_page', 1))
                                            <li><a href="{{ route('services') }}">Services</a></li>
                                        @endif
                                        @if(\App\Models\Setting::get('show_portfolio_page', 1))
                                            <li><a href="{{ route('portfolio') }}">Portfolio</a></li>
                                        @endif
                                        @if(\App\Models\Setting::get('show_blog_page', 1))
                                            <li><a href="{{ route('blog') }}">Blog</a></li>
                                        @endif
                                        @if(\App\Models\Setting::get('show_team_page', 1))
                                            <li><a href="{{ route('team') }}">Team</a></li>
                                        @endif
                                        @if(\App\Models\Setting::get('show_faq_page', 1))
                                            <li><a href="{{ route('faq') }}">FAQ</a></li>
                                        @endif
                                    @endif
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