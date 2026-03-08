@extends('layouts.app')

@section('title', 'FAQ - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', \App\Models\Setting::get('faq_meta_description', 'Frequently asked questions about our services.'))
@section('meta_keywords', \App\Models\Setting::get('faq_meta_keywords', 'FAQ, frequently asked questions, help, support'))
@section('canonical', route('faq'))

@push('structured_data')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            @foreach($faqs as $i => $faq)
                {
                    "@type": "Question",
                    "name": "{{ addslashes($faq->question) }}",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "{{ addslashes(strip_tags($faq->answer)) }}"
                    }
                }{{ !$loop->last ? ',' : '' }}
            @endforeach
        ]
    }
    </script>
@endpush

@section('content')

    <!--==============================
                                        Breadcumb
                                        ============================== -->
    <div class="breadcumb-wrapper"
        data-bg-src="{!! \App\Models\Setting::get('faq_hero_image') ? asset(\App\Models\Setting::get('faq_hero_image')) : asset('assets/img/bg/breadcumb-bg1-7.jpg') !!}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{!! \App\Models\Setting::get('faq_breadcrumb_title', 'FAQ') !!}</h1>
            </div>
        </div>
    </div>

    <!--==============================
                                        FAQ Area
                                        ==============================-->
    <div class="faq-area space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12">
                    <div class="title-area text-center mb-4">
                        <h2 class="sec-title h3 mb-2">{!! setting('faq_title', 'Frequently Asked Questions') !!}</h2>
                        @if(setting('faq_intro_text'))
                            <p class="sec-text">{!! setting('faq_intro_text') !!}</p>
                        @endif
                    </div>
                    <div class="accordion" id="faqAccordion">
                        @forelse($faqs as $index => $faq)
                            <div class="accordion-card style2">
                                <div class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                        aria-controls="collapse{{ $index }}">
                                        {{ $faq->question }}
                                    </button>
                                </div>
                                <div id="collapse{{ $index }}"
                                    class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                    aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">No FAQs available at the moment.</p>
                        @endforelse
                    </div>
                </div>
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