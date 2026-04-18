@extends('layouts.app')

@section('title', setting('contact_meta_title', 'Contact Us - ' . ($siteSettings['site_name'] ?? 'VMCore')))
@section('meta_description', setting('contact_meta_description', "Get in touch with us. We'd love to hear from you!"))
@section('meta_keywords', setting('contact_meta_keywords', 'contact, get in touch, reach us, support, inquiry'))
@section('canonical', route('contact'))

@push('structured_data')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "ContactPage",
        "name": "Contact {{ addslashes($siteSettings['site_name'] ?? 'VMCore') }}",
        "description": "{{ addslashes(setting('contact_meta_description', 'Get in touch with us. We would love to hear from you!')) }}",
        "url": "{{ route('contact') }}",
        "mainEntity": {
            "@@type": "Organization",
            "name": "{{ addslashes($siteSettings['site_name'] ?? 'VMCore') }}",
            "url": "{{ url('/') }}",
            "telephone": "{{ $siteSettings['site_phone'] ?? '' }}",
            "email": "{{ $siteSettings['site_email'] ?? '' }}",
            "address": {
                "@@type": "PostalAddress",
                "streetAddress": "{{ addslashes($siteSettings['site_address'] ?? '') }}"
            }
        }
    }
    </script>
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
                "name": "Contact",
                "item": "{{ route('contact') }}"
            }
        ]
    }
    </script>
@endpush
@push('styles')
    {{-- Contact Page Specific Styles are now in global style.css --}}
@endpush

@section('content')
<div class="flex-grow bg-[#F9F9F7]">
    {{-- Page Header --}}
    <section class="container-custom pt-20 pb-12 px-8 text-center max-w-4xl mx-auto animate-fade-in-up">
        <span class="text-sm font-medium text-secondary uppercase tracking-widest block mb-4">{!! setting('contact_hero_label', 'Contact Us') !!}</span>
        <h1 class="text-5xl lg:text-7xl font-bold leading-tight mb-6 contact-hero-title text-slate-900">
            {!! setting('contact_hero_title', "Let's Start a Conversation") !!}
        </h1>
        <p class="text-base leading-relaxed text-slate-500 max-w-2xl mx-auto">
            {!! setting('contact_hero_description', 'We are always looking for new opportunities and exciting projects. Let\'s work together.') !!}
        </p>
    </section>

    <section class="max-w-7xl mx-auto px-6 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-20 items-start">
            {{-- Content: Info Cards --}}
            <div class="motion-reveal" style="transition-delay: 0.2s;">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 gap-8 mt-4 lg:mt-0">
                    <div>
                        <h3 class="text-xl lg:text-2xl font-semibold mb-2 text-slate-900">{!! setting('contact_label_address', 'Office Address') !!}</h3>
                        <p class="text-base leading-relaxed text-slate-500">
                            {!! nl2br(e($siteSettings['site_address'] ?? 'Address Address, Rissttin Road, VMCore, FY 37028')) !!}
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl lg:text-2xl font-semibold mb-2 text-slate-900">{!! setting('contact_label_phone', 'Phone') !!}</h3>
                        <p class="text-base leading-relaxed text-slate-500">
                            @if(!empty($siteSettings['site_phone']))
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['site_phone']) }}" class="hover:text-[#4A76B2] transition-colors">
                                    {{ $siteSettings['site_phone'] }}
                                </a>
                            @else
                                {{ setting('contact_fallback_phone', '+1 (285) 335-5200') }}
                            @endif
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl lg:text-2xl font-semibold mb-2 text-slate-900">{!! setting('contact_label_email', 'Email') !!}</h3>
                        <p class="text-base leading-relaxed text-slate-500">
                            @if(!empty($siteSettings['site_email']))
                                <a href="mailto:{{ $siteSettings['site_email'] }}" class="hover:text-[#4A76B2] transition-colors">
                                    {{ $siteSettings['site_email'] }}
                                </a>
                            @else
                                {{ setting('contact_fallback_email', 'wmventl@vmcore.com') }}
                            @endif
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl lg:text-2xl font-semibold mb-4 text-slate-900">{!! setting('contact_label_social', 'Social Media') !!}</h3>
                        <div class="flex gap-4">
                            @if(isset($socialLinks) && $socialLinks->count() > 0)
                                @foreach($socialLinks as $social)
                                    <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer"
                                        class="cursor-pointer hover:opacity-60 text-gray-600"
                                        aria-label="{{ $social->platform ?? 'Social media' }}">
                                        @if(strtolower($social->platform) === 'facebook')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                        </svg>
                                        @elseif(strtolower($social->platform) === 'twitter' || strtolower($social->platform) === 'x')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                            <path
                                            d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z" />
                                        </svg>
                                        @elseif(strtolower($social->platform) === 'instagram')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                                        </svg>
                                        @elseif(strtolower($social->platform) === 'linkedin')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                            <rect x="2" y="9" width="4" height="12" />
                                            <circle cx="4" cy="4" r="2" />
                                        </svg>
                                        @elseif(strtolower($social->platform) === 'youtube')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                            <path
                                            d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17" />
                                            <path d="m10 15 5-3-5-3z" />
                                        </svg>
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M2 12h20" />
                                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                                        </svg>
                                        @endif
                                    </a>
                                    @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Contact Form --}}
            <div class="motion-reveal" style="transition-delay: 0.3s;">
                <div class="bg-white p-8 lg:p-12 rounded-lg shadow-sm border border-gray-100">
                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form id="contactForm" action="{{ route('contact.store') }}" method="POST" class="space-y-10">
                        @csrf
                        {{-- Honeypot Field --}}
                        <input type="hidden" name="company_name_hp" tabindex="-1" autocomplete="off" class="hidden" hidden>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-10 gap-2">
                            <div>
                                <label class="block text-sm font-medium mb-3 uppercase tracking-tight text-slate-900">
                                    {!! setting('contact_field_name', 'Name') !!} <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    required
                                    type="text" 
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="w-full border @error('name') border-red-500 @else border-slate-200 @enderror p-3 rounded-sm focus:outline-none focus:border-[#4A76B2] transition-colors contact-form-input"
                                    placeholder="Your full name"
                                >
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-3 uppercase tracking-tight text-slate-900">
                                    {!! setting('contact_field_email', 'Email') !!} <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    required
                                    type="email" 
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="w-full border @error('email') border-red-500 @else border-slate-200 @enderror p-3 rounded-sm focus:outline-none focus:border-[#4A76B2] transition-colors contact-form-input"
                                    placeholder="your@email.com"
                                >
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-10 gap-2">
                            <div class="mt-3">
                                <label class="block text-sm font-medium mb-3 uppercase tracking-tight text-slate-900">
                                    {!! setting('contact_field_phone', 'Phone No') !!}
                                </label>
                                <input 
                                    type="tel" 
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    class="w-full border border-slate-200 p-3 rounded-sm focus:outline-none focus:border-[#4A76B2] transition-colors contact-form-input"
                                    placeholder="+1 (000) 000-0000"
                                >
                            </div>
                            <div class="mt-3">
                                <label class="block text-sm font-medium mb-3 uppercase tracking-tight text-slate-900">
                                    {!! setting('contact_field_subject', 'Subject') !!} <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    required
                                    type="text" 
                                    name="subject"
                                    value="{{ old('subject') }}"
                                    class="w-full border @error('subject') border-red-500 @else border-slate-200 @enderror p-3 rounded-sm focus:outline-none focus:border-[#4A76B2] transition-colors contact-form-input"
                                    placeholder="What is this regarding?"
                                >
                                @error('subject') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="block text-sm font-medium mb-3 uppercase tracking-tight text-slate-900">
                                {!! setting('contact_field_message', 'Message') !!} <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                required
                                name="message"
                                rows="5"
                                class="w-full border @error('message') border-red-500 @else border-slate-200 @enderror p-4 rounded-sm focus:outline-none focus:border-[#4A76B2] transition-colors resize-none contact-form-input"
                                placeholder="Tell us more about your project..."
                            >{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <button type="submit" class="w-full bg-[#4A76B2] text-white py-4 rounded-sm text-sm font-medium uppercase tracking-widest cursor-pointer hover:bg-[#3A6096] hover:-translate-y-1 hover:shadow-[0_10px_20px_rgba(74,118,178,0.3)] transition-all duration-300 shadow-md mt-4">
                            {!! setting('contact_submit_text', 'Send Message') !!}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Map Section --}}
    <!-- <div class="max-w-7xl mx-auto px-6 my-20 motion-reveal">
        @if(!empty(setting('contact_map_embed')))
            <div class="relative w-full h-[500px] rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                {!! setting('contact_map_embed') !!}
            </div>
        @else
            <div class="relative w-full h-[500px] rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                {{-- Mock Map fallback if no embed code --}}
                <div 
                    class="absolute inset-0 bg-cover bg-center grayscale-[0.5] opacity-80"
                    style="background-image: url('https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?auto=format&fit=crop&q=80&w=2000')"
                ></div>
                
                <div class="absolute top-4 left-4 flex bg-white rounded-sm shadow-md overflow-hidden text-xs font-bold uppercase">
                    <button class="px-4 py-2 bg-white border-r border-gray-100 hover:bg-gray-50">Map</button>
                    <button class="px-4 py-2 bg-gray-50 text-gray-400 hover:bg-gray-100">Satellite</button>
                </div>
                
                <div class="absolute top-4 right-4 bg-white p-2 rounded-sm shadow-md">
                    <div class="w-6 h-6 flex items-center justify-center text-gray-600">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                    </div>
                </div>

                {{-- Map Marker --}}
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
                    <div class="bg-white px-4 py-2 rounded-sm shadow-xl border border-gray-100 mb-2 whitespace-nowrap">
                        <p class="text-sm font-medium text-slate-900">{{ $siteSettings['site_address'] ?? 'A05, Risetin Road.' }}</p>
                        <p class="text-xs text-slate-500">VMCore, FY 37028</p>
                    </div>
                    <div class="w-8 h-8 bg-gray-900 rounded-full flex items-center justify-center shadow-lg border-2 border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    </div>
                </div>

                {{-- Map Controls --}}
                <div class="absolute bottom-10 right-4 flex flex-col gap-1">
                    <button class="w-8 h-8 bg-white flex items-center justify-center shadow-md rounded-sm text-xl font-light">+</button>
                    <button class="w-8 h-8 bg-white flex items-center justify-center shadow-md rounded-sm text-xl font-light">−</button>
                </div>
                
                <div class="absolute bottom-4 left-4">
                    <span class="text-sm font-bold text-gray-400 italic">Google</span>
                </div>
                
                <div class="absolute bottom-4 right-20 text-xs text-slate-500 bg-white/80 px-2 py-0.5 rounded-sm">
                    Map data ©2026 Google Terms of Use
                </div>
            </div>
        @endif
    </div> -->
</div>
@endsection

@push('scripts')
    {{-- Contact Page Specific Scripts are now in global script.js --}}
    @if(setting('google_verification_enabled', '0') == '1')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var recaptchaLoaded = false;
                function loadRecaptcha() {
                    if (recaptchaLoaded) return;
                    recaptchaLoaded = true;
                    var script = document.createElement('script');
                    script.src = "https://www.google.com/recaptcha/api.js?render={{ setting('google_recaptcha_site_key') }}";
                    script.async = true;
                    script.defer = true;
                    document.head.appendChild(script);
                }
                
                // Load on first interaction to improve PageSpeed
                ['mousemove', 'scroll', 'touchstart', 'keydown'].forEach(function(e) {
                    window.addEventListener(e, loadRecaptcha, { once: true, passive: true });
                });

                var form = document.getElementById('contactForm');
                if (form) {
                    form.addEventListener('focusin', loadRecaptcha);
                    form.addEventListener('mouseenter', loadRecaptcha);
                    
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        var submitBtn = form.querySelector('button[type="submit"]');
                        if (submitBtn) {
                            submitBtn.disabled = true;
                            submitBtn.innerHTML = 'Sending...';
                        }
                        
                        loadRecaptcha();
                        var checkInterval = setInterval(function() {
                            if (typeof grecaptcha !== 'undefined' && grecaptcha.execute) {
                                clearInterval(checkInterval);
                                grecaptcha.ready(function() {
                                    grecaptcha.execute('{{ setting('google_recaptcha_site_key') }}', {action: 'submit'}).then(function(token) {
                                        var input = form.querySelector('input[name="g-recaptcha-response"]');
                                        if (!input) {
                                            input = document.createElement('input');
                                            input.type = 'hidden';
                                            input.name = 'g-recaptcha-response';
                                            form.appendChild(input);
                                        }
                                        input.value = token;
                                        form.submit();
                                    });
                                });
                            }
                        }, 100);
                    });
                }
            });
        </script>
    @else
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var form = document.getElementById('contactForm');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        var submitBtn = form.querySelector('button[type="submit"]');
                        if (submitBtn && !submitBtn.disabled) {
                            submitBtn.disabled = true;
                            submitBtn.innerHTML = 'Sending...';
                        }
                    });
                }
            });
        </script>
    @endif
@endpush