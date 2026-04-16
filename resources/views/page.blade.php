@extends('layouts.app')

@section('title', $page->meta_title ?: ($page->title . ' - ' . ($siteSettings['site_name'] ?? 'VMCore')))
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('canonical', url()->current())

@push('structured_data')
    <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@@type": "ListItem",
                    "position": 1,
                    "name": "Home",
                    "item": "{{ url('/') }}"
                },
                {
                    "@@type": "ListItem",
                    "position": 2,
                    "name": "{{ addslashes($page->title) }}",
                    "item": "{{ url()->current() }}"
                }
            ]
        }
        </script>
@endpush
@section('content')
    <!--==============================
            Breadcumb
            ============================== -->
    {{-- <div class="breadcumb-wrapper">
        <div class="container z-index-common">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{{ $page->title }}</h1>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>{{ $page->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}

    <!--==============================
            Page Area
            ==============================-->
    <section class="space-top space-extra-bottom">
        <div class="container">
            @if($page->featured_image)
                <div class="mb-5 text-center">
                    <img src="{{ asset($page->featured_image) }}" alt="{{ $page->title }}" class="img-fluid rounded">
                </div>
            @endif
            <div class="page-content ckeditor-content">
                {!! $page->content !!}
            </div>
        </div>
    </section>
@endsection