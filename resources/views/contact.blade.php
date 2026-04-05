@extends('layouts.app')

@section('title', 'Contact Us - ' . ($siteSettings['site_name'] ?? 'VMCore'))
@section('meta_description', \App\Models\Setting::get('contact_meta_description', "Get in touch with us. We'd love to hear from you!"))

@push('styles')
    {{-- Contact Page Specific Styles are now in global style.css --}}
@endpush

@section('content')
<div class="flex-grow bg-[#F9F9F7]">
    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-20 items-start">
            {{-- Content: Hero + Info Cards --}}
            <div class="motion-reveal" style="transition-delay: 0.2s;">
                {{-- Contact Hero --}}
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight mb-12 contact-hero-title">
                    {!! setting('contact_hero_title', "Let's Start a Conversation") !!}
                </h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-2">Office Address</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {!! nl2br(e($siteSettings['site_address'] ?? 'Address Address, Rissttin Road, VMCore, FY 37028')) !!}
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-2">Phone</h3>
                        <p class="text-gray-600">
                            @if(!empty($siteSettings['site_phone']))
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['site_phone']) }}" class="hover:text-[#4A76B2] transition-colors">
                                    {{ $siteSettings['site_phone'] }}
                                </a>
                            @else
                                +1 (285) 335-5200
                            @endif
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-2">Email</h3>
                        <p class="text-gray-600">
                            @if(!empty($siteSettings['site_email']))
                                <a href="mailto:{{ $siteSettings['site_email'] }}" class="hover:text-[#4A76B2] transition-colors">
                                    {{ $siteSettings['site_email'] }}
                                </a>
                            @else
                                wmventl@vmcore.com
                            @endif
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">Social Media</h3>
                        <div class="flex gap-4">
                            @if(!empty($siteSettings['facebook_url']))
                                <a href="{{ $siteSettings['facebook_url'] }}" target="_blank" class="bg-gray-900 text-white p-2.5 rounded-full hover:bg-[#4A76B2] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                                </a>
                            @endif
                            @if(!empty($siteSettings['twitter_url']))
                                <a href="{{ $siteSettings['twitter_url'] }}" target="_blank" class="bg-gray-900 text-white p-2.5 rounded-full hover:bg-[#4A76B2] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path></svg>
                                </a>
                            @endif
                            @if(!empty($siteSettings['instagram_url']))
                                <a href="{{ $siteSettings['instagram_url'] }}" target="_blank" class="bg-gray-900 text-white p-2.5 rounded-full hover:bg-[#4A76B2] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                                </a>
                            @endif
                            @if(!empty($siteSettings['linkedin_url']))
                                <a href="{{ $siteSettings['linkedin_url'] }}" target="_blank" class="bg-gray-900 text-white p-2.5 rounded-full hover:bg-[#4A76B2] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Contact Form --}}
            <div class="motion-reveal" style="transition-delay: 0.3s;">
                <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100">
                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        {{-- Honeypot Field --}}
                        <div style="display:none !important;">
                            <input type="text" name="company_name_hp" tabindex="-1" autocomplete="off">
                        </div>

                        <div>
                            <label class="block text-sm font-bold mb-2 uppercase tracking-tight">
                                Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                required
                                type="text" 
                                name="name"
                                value="{{ old('name') }}"
                                class="w-full border @error('name') border-red-500 @else border-gray-200 @enderror p-3 rounded-sm focus:outline-none focus:border-brand-blue transition-colors contact-form-input"
                                placeholder="Your full name"
                            >
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 uppercase tracking-tight">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input 
                                required
                                type="email" 
                                name="email"
                                value="{{ old('email') }}"
                                class="w-full border @error('email') border-red-500 @else border-gray-200 @enderror p-3 rounded-sm focus:outline-none focus:border-brand-blue transition-colors contact-form-input"
                                placeholder="your@email.com"
                            >
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 uppercase tracking-tight">
                                Phone No
                            </label>
                            <input 
                                type="tel" 
                                name="phone"
                                value="{{ old('phone') }}"
                                class="w-full border border-gray-200 p-3 rounded-sm focus:outline-none focus:border-brand-blue transition-colors contact-form-input"
                                placeholder="+1 (000) 000-0000"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 uppercase tracking-tight">
                                Subject <span class="text-red-500">*</span>
                            </label>
                            <input 
                                required
                                type="text" 
                                name="subject"
                                value="{{ old('subject') }}"
                                class="w-full border @error('subject') border-red-500 @else border-gray-200 @enderror p-3 rounded-sm focus:outline-none focus:border-brand-blue transition-colors contact-form-input"
                                placeholder="What is this regarding?"
                            >
                            @error('subject') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2 uppercase tracking-tight">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                required
                                name="message"
                                rows="4"
                                class="w-full border @error('message') border-red-500 @else border-gray-200 @enderror p-3 rounded-sm focus:outline-none focus:border-brand-blue transition-colors resize-none contact-form-input"
                                placeholder="Tell us more about your project..."
                            >{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        <button type="submit" class="w-full bg-[#4A76B2] text-white py-4 rounded-sm font-bold uppercase tracking-widest hover:bg-opacity-90 transition-all shadow-md">
                            Send Message
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
                        <p class="text-xs font-bold">{{ $siteSettings['site_address'] ?? 'A05, Risetin Road.' }}</p>
                        <p class="text-[10px] text-gray-500">VMCore, FY 37028</p>
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
                
                <div class="absolute bottom-4 right-20 text-[10px] text-gray-500 bg-white/80 px-2 py-0.5 rounded-sm">
                    Map data ©2026 Google Terms of Use
                </div>
            </div>
        @endif
    </div> -->
</div>
@endsection

@push('scripts')
    {{-- Contact Page Specific Scripts are now in global script.js --}}
@endpush