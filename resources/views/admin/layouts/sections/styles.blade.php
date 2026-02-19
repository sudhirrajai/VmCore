<!-- BEGIN: Theme CSS-->
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">

<!-- Fonts Icons (iconify) -->
<!-- Fonts Icons (iconify) -->
@vite(['resources/assets/admin/vendor/fonts/iconify/iconify.css'])

<!-- Core CSS -->
@vite([
    'resources/assets/admin/vendor/scss/core.scss',
    'resources/assets/admin/css/demo.css'
])

<!-- Vendor Styles -->
@vite(['resources/assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.scss'])
@yield('vendor-style')

<!-- Page Styles -->
@yield('page-style')

<!-- app CSS removed to avoid Tailwind conflict with Bootstrap -->