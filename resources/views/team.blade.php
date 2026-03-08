@extends('layouts.app')

@section('title', 'Team - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', \App\Models\Setting::get('team_meta_description', 'Meet our talented team of professionals.'))
@section('meta_keywords', \App\Models\Setting::get('team_meta_keywords', 'team, professionals, experts, creative team, VMCore team'))
@section('canonical', route('team'))

@section('content')

    <!--==============================
                        Breadcumb
                        ============================== -->
    <div class="breadcumb-wrapper"
        data-bg-src="{!! \App\Models\Setting::get('team_hero_image') ? asset(\App\Models\Setting::get('team_hero_image')) : asset('assets/img/bg/breadcumb-bg1-4.jpg') !!}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{!! \App\Models\Setting::get('team_breadcrumb_title', 'Our Team') !!}</h1>
            </div>
        </div>
    </div>

    @if(\App\Models\Setting::get('team_page_intro'))
        <div class="container text-center py-4">
            <p class="lead">{!! \App\Models\Setting::get('team_page_intro') !!}</p>
        </div>
    @endif

    <!--==============================
                        Team Area
                        ==============================-->
    <div class="team-area space">
        <div class="container">
            <div class="row gy-40 justify-content-center">
                @forelse($teamMembers as $member)
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="team-card text-center">
                            <div class="team-card_img">
                                <a href="{{ route('team.detail', $member->slug) }}">
                                    <img src="{{ $member->image ? asset($member->image) : asset('assets/img/team/team_1_1.jpg') }}"
                                        alt="{{ $member->name }}">
                                </a>
                            </div>
                            <div class="team-card_content">
                                <h4 class="team-card_title"><a
                                        href="{{ route('team.detail', $member->slug) }}">{{ $member->name }}</a></h4>
                                <span class="team-card_desig">{{ $member->designation }}</span>
                                @if(is_array($member->social_links) && count($member->social_links))
                                    <div class="social-btn mt-15">
                                        @foreach($member->social_links as $platform => $url)
                                            @if($url)
                                                <a href="{{ $url }}" target="_blank"><i class="fab fa-{{ $platform }}"></i></a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No team members to display.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!--==============================
                        Marquee Area
                        ==============================-->
    <div class="container-fluid p-0 overflow-hidden">
        <div class="slider__marquee clearfix marquee-wrap">
            <div class="marquee_mode marquee__group">
                @for($i = 0; $i < 4; $i++)
                    <h6 class="item m-item"><a href="javascript:void(0)"><i class="fas fa-star-of-life"></i>
                            {{ $siteSettings['marquee_text'] ?? 'We Give Unparalleled Flexibility' }}</a></h6>
                @endfor
            </div>
        </div>
    </div>

@endsection