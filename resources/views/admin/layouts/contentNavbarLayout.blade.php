@isset($pageConfigs)
    {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@extends('admin.layouts.commonMaster')

@php
    /* Display elements */
    $contentNavbar = $contentNavbar ?? true;
    $containerNav = $containerNav ?? 'container-xxl';
    $isNavbar = $isNavbar ?? true;
    $isMenu = $isMenu ?? true;
    $isFlex = $isFlex ?? false;
    $isFooter = $isFooter ?? true;
    $customizerHidden = $customizerHidden ?? '';

    /* HTML Classes */
    $navbarDetached = 'navbar-detached';
    $menuFixed = isset($configData['menuFixed']) ? $configData['menuFixed'] : '';
    if (isset($navbarType)) {
        $configData['navbarType'] = $navbarType;
    }
    $navbarType = isset($configData['navbarType']) ? $configData['navbarType'] : '';
    $footerFixed = isset($configData['footerFixed']) ? $configData['footerFixed'] : '';
    $menuCollapsed = isset($configData['menuCollapsed']) ? $configData['menuCollapsed'] : '';

    /* Content classes */
    $container = ($container ?? 'container-xxl');

@endphp

@section('layoutContent')
    <div class="layout-wrapper layout-content-navbar {{ $isMenu ? '' : 'layout-without-menu' }}">
        <div class="layout-container">

            @if ($isMenu)
                @include('admin.layouts.sections.menu.verticalMenu')
            @endif


            <!-- Layout page -->
            <div class="layout-page">

                {{-- Below commented code read by artisan command while installing jetstream. !! Do not remove if you want
                to use jetstream. --}}
                {{-- <x-banner /> --}}

                <!-- BEGIN: Navbar-->
                @if ($isNavbar)
                    @include('admin.layouts.sections.navbar.navbar')
                @endif
                <!-- END: Navbar-->

                {{-- Flash notifications --}}
                @if(session('cache_cleared') || session('success'))
                    <div class="container-xxl">
                        <div class="alert alert-success alert-dismissible d-flex align-items-center mt-3 mb-0" role="alert">
                            <i class="bx bx-check-circle me-2 fs-5"></i>
                            <span>{{ session('cache_cleared') ?? session('success') }}</span>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @endif


                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    @if ($isFlex)
                        <div class="{{ $container }} d-flex align-items-stretch flex-grow-1 p-0">
                    @else
                            <div class="{{ $container }} flex-grow-1 container-p-y">
                        @endif

                            @yield('content')

                            @include('admin.content._partials.delete-modal')

                        </div>
                        <!-- / Content -->

                        <!-- Footer -->
                        @if ($isFooter)
                            @include('admin.layouts.sections.footer.footer')
                        @endif
                        <!-- / Footer -->
                        <div class="content-backdrop fade"></div>
                    </div>
                    <!--/ Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            @if ($isMenu)
                <!-- Overlay -->
                <div class="layout-overlay layout-menu-toggle"></div>
            @endif
            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>
        </div>
        <!-- / Layout wrapper -->
    </div>
@endsection