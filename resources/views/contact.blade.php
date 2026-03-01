@extends('layouts.app')

@section('title', 'Contact Us - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', \App\Models\Setting::get('contact_meta_description', "Get in touch with us. We'd love to hear from you!"))

@section('content')

    <!--==============================
                                            Breadcumb
                                            ============================== -->
    <div class="breadcumb-wrapper"
        data-bg-src="{!! \App\Models\Setting::get('contact_hero_image') ? asset(\App\Models\Setting::get('contact_hero_image')) : asset('assets/img/bg/breadcumb-bg1-6.jpg') !!}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{!! \App\Models\Setting::get('contact_breadcrumb_title', 'Contact Us') !!}</h1>
            </div>
        </div>
    </div>

    <!--==============================
                                            Contact Info Area
                                            ==============================-->
    <div class="contact-info-area space">
        <div class="container">
            <div class="row gy-30 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="contact-info-card text-center p-4">
                        <i class="fas fa-map-marker-alt fa-2x mb-15"></i>
                        <h5>Address</h5>
                        <p>{{ $siteSettings['site_address'] ?? 'Address not set' }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-info-card text-center p-4">
                        <i class="fas fa-phone fa-2x mb-15"></i>
                        <h5>Phone</h5>
                        @if(!empty($siteSettings['site_phone']))
                            <p><a
                                    href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['site_phone']) }}">{{ $siteSettings['site_phone'] }}</a>
                            </p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-info-card text-center p-4">
                        <i class="fas fa-envelope fa-2x mb-15"></i>
                        <h5>Email</h5>
                        @if(!empty($siteSettings['site_email']))
                            <p><a href="mailto:{{ $siteSettings['site_email'] }}">{{ $siteSettings['site_email'] }}</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--==============================
                                            Contact Form Area
                                            ==============================-->
    <div class="contact-area-1 space bg-theme">
        <div class="contact-map shape-mockup wow img-custom-anim-left" data-wow-duration="1.5s" data-wow-delay="0.2s"
            data-left="0" data-top="-100px" data-bottom="140px">
            <img src="{{ setting('contact_image') ? asset(setting('contact_image')) : asset('assets/img/bg/breadcumb-bg1-6.jpg') }}"
                alt="Contact Us" style="width:100%; height:100%; object-fit:cover;">
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-end">
                <div class="col-lg-6">
                    <div class="contact-form-wrap">
                        <div class="title-area mb-30">
                            <h2 class="sec-title">{!! setting('contact_form_title', 'Have Any Project on Your Mind?') !!}
                            </h2>
                            <p>{!! setting('contact_form_subtitle', "Great! We're excited to hear from you and let's start something") !!}
                            </p>
                        </div>
                        <div id="form-messages"></div>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('contact.store') }}" method="POST" class="contact-form" id="ajaxContactForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control style-border" name="name"
                                            value="{{ old('name') }}" placeholder="Full name*" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control style-border" name="email"
                                            value="{{ old('email') }}" placeholder="Email address*" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control style-border" name="phone"
                                            value="{{ old('phone') }}" placeholder="Phone number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control style-border" name="subject"
                                            value="{{ old('subject') }}" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea name="message" placeholder="How Can We Help You*"
                                            class="form-control style-border" required>{{ old('message') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-btn col-12">
                                <button type="submit" class="btn mt-20">
                                    <span class="link-effect">
                                        <span class="effect-1">SEND MESSAGE</span>
                                        <span class="effect-1">SEND MESSAGE</span>
                                    </span>
                                </button>
                            </div>
                        </form>
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

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form = document.getElementById('ajaxContactForm');
                const formMessages = document.getElementById('form-messages');

                if (!form) return;

                const submitBtn = form.querySelector('button[type="submit"]');
                const submitText = submitBtn.innerHTML;

                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    // Disable button and show loading state
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="link-effect"><span class="effect-1">SENDING...</span><span class="effect-1">SENDING...</span></span>';
                    formMessages.innerHTML = '';
                    formMessages.className = '';

                    const formData = new FormData(form);

                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                        body: formData
                    })
                        .then(async response => {
                            const data = await response.json();

                            if (!response.ok) {
                                // Handle Validation Errors (422) or Server Errors (500)
                                throw { status: response.status, data: data };
                            }

                            return data;
                        })
                        .then(data => {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = submitText;

                            if (data.success) {
                                formMessages.className = 'alert alert-success';
                                formMessages.innerHTML = data.message;
                                form.reset(); // clear the form
                            }
                        })
                        .catch(error => {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = submitText;

                            formMessages.className = 'alert alert-danger';

                            if (error.status === 422 && error.data && error.data.errors) {
                                // It's a validation error
                                let errorsHtml = '<ul class="mb-0">';
                                for (const [key, messages] of Object.entries(error.data.errors)) {
                                    messages.forEach(msg => {
                                        errorsHtml += `<li>${msg}</li>`;
                                    });
                                }
                                errorsHtml += '</ul>';
                                formMessages.innerHTML = errorsHtml;
                            } else if (error.data && error.data.message) {
                                formMessages.innerHTML = error.data.message;
                            } else {
                                formMessages.innerHTML = 'An unexpected error occurred. Please try again later.';
                            }
                        });
                });
            });
        </script>
    @endpush

@endsection