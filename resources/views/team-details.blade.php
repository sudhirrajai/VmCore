@extends('layouts.app')

@section('title', ($member->meta_title ?? $member->name) . ' - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', $member->meta_description ?? Str::limit($member->bio, 160) ?? '')
@section('meta_keywords', $member->designation ? $member->designation . ', ' . ($siteSettings['site_name'] ?? 'VMCore') . ' team' : '')
@section('canonical', route('team.detail', $member->slug))
@if($member->image)
@section('og_image', asset($member->image))
@endif

@push('structured_data')
    <script type="application/ld+json">
            {
                "@@context": "https://schema.org",
                "@@type": "Person",
                "name": "{{ addslashes($member->name) }}",
                "jobTitle": "{{ addslashes($member->designation ?? '') }}",
                "description": "{{ addslashes(Str::limit($member->meta_description ?? strip_tags($member->bio ?? ''), 200)) }}",
                "image": "{{ $member->image ? asset($member->image) : '' }}",
                "url": "{{ route('team.detail', $member->slug) }}",
                "worksFor": {
                    "@@type": "Organization",
                    "name": "{{ addslashes($siteSettings['site_name'] ?? 'VMCore') }}"
                }{{ $member->email ? ', "email": "' . $member->email . '"' : '' }}{{ $member->phone ? ', "telephone": "' . $member->phone . '"' : '' }}
            }
            </script>
@endpush



@section('content')

    <!--==============================
                            Breadcumb
                            ============================== -->
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('assets/img/bg/breadcumb-bg1-4.jpg') }}">
        <div class="container">
                <h1 class="text-5xl lg:text-7xl font-bold leading-tight breadcumb-title">{{ $member->name }}</h1>
            </div>
        </div>
    </div>

    <!--==============================
                            Team Details
                            ==============================-->
    <div class="team-details space">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="team-details-img mb-30">
                        <img src="{{ $member->image ? asset($member->image) : asset('assets/img/team/team_1_1.jpg') }}"
                            alt="{{ $member->name }}" class="w-100" style="border-radius: 16px;">
                    </div>

                    <aside class="custom-sidebar">
                        <div class="custom-widget-box mt-30">
                            <h4 class="text-xl lg:text-2xl font-semibold mb-4 custom-widget-title text-slate-900">Contact Info</h4>
                            <ul class="custom-info-list team-details-info text-sm text-slate-500">
                                @if($member->email)
                                    <li>
                                        <div class="icon-wrapper"><i class="fas fa-envelope"></i></div>
                                        <div class="content-wrapper">
                                            <span class="label">Email</span>
                                            <span class="value"><a
                                                    href="mailto:{{ $member->email }}">{{ $member->email }}</a></span>
                                        </div>
                                    </li>
                                @endif
                                @if($member->phone)
                                    <li>
                                        <div class="icon-wrapper"><i class="fas fa-phone"></i></div>
                                        <div class="content-wrapper">
                                            <span class="label">Phone</span>
                                            <span class="value"><a
                                                    href="tel:{{ $member->phone }}">{{ $member->phone }}</a></span>
                                        </div>
                                    </li>
                                @endif
                                @if(is_array($member->social_links) && count($member->social_links))
                                    <li>
                                        <div class="icon-wrapper"><i class="fas fa-share-alt"></i></div>
                                        <div class="content-wrapper">
                                            <span class="label">Social</span>
                                            <div class="value">
                                                <div class="social-btn mt-2">
                                                    @foreach($member->social_links as $platform => $url)
                                                        @if($url)
                                                            <a href="{{ $url }}" target="_blank"><i
                                                                    class="fab fa-{{ $platform }}"></i></a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </aside>
                </div>
                <div class="col-lg-8">
                    <h2 class="text-2xl lg:text-4xl font-semibold leading-tight mb-2 text-slate-900">{{ $member->name }}</h2>
                    <span class="text-sm text-slate-500">{{ $member->designation }}</span>
                    @if($member->bio)
                        <div class="team-details-bio mt-30">
                            {!! $member->bio !!}
                        </div>
                    @endif

                    @if($member->testimonials->count())
                        <div class="mt-50">
                            <h4 class="text-xl lg:text-2xl font-semibold mb-4 text-slate-900">What Clients Say</h4>
                            @foreach($member->testimonials as $testimonial)
                                <div class="testi-card p-4 border rounded mb-20">
                                    <p class="text-base leading-relaxed text-slate-500 italic mb-4">"{{ $testimonial->content }}"</p>
                                    <strong class="text-sm font-medium text-slate-900 mb-1 block">{{ $testimonial->name }}</strong>
                                    @if($testimonial->company)<small class="text-xs text-slate-500 block">{{ $testimonial->designation }},
                                    {{ $testimonial->company }}</small>@endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection