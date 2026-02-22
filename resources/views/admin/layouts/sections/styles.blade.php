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

<style>
    :root,
    [data-bs-theme=light],
    [data-bs-theme=dark] {
        --bs-primary:
            {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
            !important;
        --bs-primary-rgb:
            {{ \App\Helpers\ThemeHelper::getPrimaryColorRgb() }}
            !important;
        --bs-link-color:
            {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
            !important;
        --bs-link-hover-color:
            {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
            !important;

        /* Font and Background */
        --bs-body-color:
            {{ \App\Helpers\ThemeHelper::getFontColor() }}
            !important;
        --bs-body-bg:
            {{ \App\Helpers\ThemeHelper::getBackgroundColor() }}
            !important;

        /* Dark Mode Overrides to keep same color */
        --bs-primary-text-emphasis:
            {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
            !important;
        --bs-primary-bg-subtle: rgba({{ \App\Helpers\ThemeHelper::getPrimaryColorRgb() }}, 0.1) !important;
        --bs-primary-border-subtle: rgba({{ \App\Helpers\ThemeHelper::getPrimaryColorRgb() }}, 0.4) !important;
    }

    /* Ensure body bg is applied */
    body {
        background-color:
            {{ \App\Helpers\ThemeHelper::getBackgroundColor() }}
            !important;
        color:
            {{ \App\Helpers\ThemeHelper::getFontColor() }}
            !important;
    }

    .btn-primary {
        background-color:
            {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
            !important;
        border-color:
            {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
            !important;
    }

    .btn-outline-primary {
        color:
            {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
            !important;
        border-color:
            {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
            !important;
    }

    .btn-outline-primary:hover {
        background-color:
            {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
            !important;
        color: #fff !important;
    }

    .text-primary {
        color:
            {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
            !important;
    }

    .bg-primary {
        background-color:
            {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
            !important;
    }

    /* Pagination active state */
    .page-item.active .page-link {
        background-color:
            {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
            !important;
        border-color:
            {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
            !important;
    }

    /* Menu active state */
    .menu-item.active>.menu-link {
        color:
            {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
            !important;
        background-color: rgba({{ \App\Helpers\ThemeHelper::getPrimaryColorRgb() }}, 0.16) !important;
    }

    .menu-item.active>.menu-link:before {
        background-color:
            {{ \App\Helpers\ThemeHelper::getPrimaryColor() }}
            !important;
    }
</style>