@extends('layouts.app')

@section('title', ($member->meta_title ?? $member->name) . ' - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', $member->meta_description ?? Str::limit($member->bio, 160) ?? '')

@section('content')

    <!--==============================
            Breadcumb
            ============================== -->
    <div class="breadcumb-wrapper" data-bg-src="{{ asset('assets/img/bg/breadcumb-bg1-4.jpg') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{{ $member->name }}</h1>
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
                            alt="{{ $member->name }}" class="w-100">
                    </div>
                    @if(is_array($member->social_links) && count($member->social_links))
                        <div class="social-btn mt-20">
                            @foreach($member->social_links as $platform => $url)
                                @if($url)
                                    <a href="{{ $url }}" target="_blank"><i class="fab fa-{{ $platform }}"></i></a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <ul class="team-details-info mt-30">
                        @if($member->email)
                            <li><i class="fas fa-envelope"></i> <a href="mailto:{{ $member->email }}">{{ $member->email }}</a>
                            </li>
                        @endif
                        @if($member->phone)
                            <li><i class="fas fa-phone"></i> <a href="tel:{{ $member->phone }}">{{ $member->phone }}</a></li>
                        @endif
                    </ul>
                </div>
                <div class="col-lg-8">
                    <h2>{{ $member->name }}</h2>
                    <span class="text-muted">{{ $member->designation }}</span>
                    @if($member->bio)
                        <div class="team-details-bio mt-30">
                            {!! $member->bio !!}
                        </div>
                    @endif

                    @if($member->testimonials->count())
                        <div class="mt-50">
                            <h4 class="mb-20">What Clients Say</h4>
                            @foreach($member->testimonials as $testimonial)
                                <div class="testi-card p-4 border rounded mb-20">
                                    <p>"{{ $testimonial->content }}"</p>
                                    <strong>{{ $testimonial->name }}</strong>
                                    @if($testimonial->company)<br><small>{{ $testimonial->designation }},
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