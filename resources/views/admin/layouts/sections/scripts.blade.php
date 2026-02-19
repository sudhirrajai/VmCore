<!-- BEGIN: Vendor JS-->
@vite([
    'resources/assets/admin/vendor/libs/jquery/jquery.js',
    'resources/assets/admin/vendor/libs/popper/popper.js',
    'resources/assets/admin/vendor/js/bootstrap.js',
    'resources/assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
    'resources/assets/admin/vendor/js/menu.js'
])

@yield('vendor-script')
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
@vite(['resources/assets/admin/js/main.js'])
<!-- END: Theme JS-->

<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->

<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->

<!-- app JS removed to avoid conflicts -->
