@if(!request()->routeIs('contact'))
<!-- CTA Section -->
<section class="px-6 py-24 w-full animate-on-scroll">
  <div class="max-w-[1440px] mx-auto grid grid-cols-1 xl:grid-cols-2 gap-12 items-center bg-card p-8 md:p-20 rounded-sm border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)]">
    <div>
      <h2 class="text-4xl md:text-5xl xl:text-7xl font-bold tracking-tighter mb-8 leading-[1.1] text-slate-900 uppercase max-w-xl">
        Let's Create <br class="hidden xl:block" /> Something Great
      </h2>
      <a href="{{ route('contact') }}" class="inline-block bg-black text-white px-10 py-4 rounded-sm text-sm font-bold tracking-widest uppercase hover:bg-opacity-90 transition-all shadow-lg">
        LET'S TALK WITH US
      </a>
    </div>
    <div>
      <p class="text-xl text-slate-600 leading-relaxed">
        We are a digital agency that helps build immersive and engaging user experiences that drive results. Our team of experts is dedicated to pushing the boundaries of what's possible in the digital space.
      </p>
    </div>
  </div>
</section>
@endif

<footer class="bg-footer py-12 px-6">
  <div class="max-w-[1440px] mx-auto w-full">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">
      <div class="col-span-1 md:col-span-5">
        <h4 class="font-bold text-base uppercase tracking-widest mb-6">Newsletter Subscription</h4>
        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="relative">
          @csrf
          <input 
            name="email"
            placeholder="Your email here" 
            class="w-full bg-white border-none px-6 py-5 pr-16 rounded-sm text-lg focus:ring-1 focus:ring-[#4A76B2] outline-none" 
            type="email" 
            required
          />
          <button type="submit" class="absolute right-6 top-1/2 -translate-y-1/2 text-gray-400 hover:text-black">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
          </button>
        </form>
        <p class="text-sm text-gray-400 mt-4 leading-relaxed">
          You can unsubscribe at any time and your data is protected by our privacy policy.
        </p>
      </div>
      
      <div class="md:col-span-2">
        <h4 class="font-bold text-sm uppercase tracking-widest mb-4">Links</h4>
        <ul class="space-y-2 text-base text-gray-600">
          <li><a href="{{ route('home') }}" class="hover:text-black">Home</a></li>
          <li><a href="{{ route('about') }}" class="hover:text-black">About</a></li>
          <li><a href="{{ route('services') }}" class="hover:text-black">Services</a></li>
          <li><a href="{{ route('portfolio') }}" class="hover:text-black">Portfolio</a></li>
          <li><a href="{{ route('faq') }}" class="hover:text-black">FAQ</a></li>
        </ul>
      </div>

      <div class="md:col-span-2">
        <h4 class="font-bold text-sm uppercase tracking-widest mb-4">Services</h4>
        <ul class="space-y-2 text-base text-gray-600">
          <li><a href="{{ route('services') }}" class="hover:text-black">Branding</a></li>
          <li><a href="{{ route('services') }}" class="hover:text-black">Graphic Design</a></li>
          <li><a href="{{ route('services') }}" class="hover:text-black">Web Development</a></li>
          <li><a href="{{ route('contact') }}" class="hover:text-black">Contact</a></li>
        </ul>
      </div>

      <div class="md:col-span-3">
        <h4 class="font-bold text-sm uppercase tracking-widest mb-4">Contact</h4>
        <div class="flex space-x-4 mb-4">
          <a href="#" class="cursor-pointer hover:opacity-60 text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
          <a href="#" class="cursor-pointer hover:opacity-60 text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg></a>
          <a href="#" class="cursor-pointer hover:opacity-60 text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg></a>
          <a href="#" class="cursor-pointer hover:opacity-60 text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/></svg></a>
        </div>
        <address class="not-italic text-base text-gray-600 space-y-1">
          <p>Address: {{ $siteSettings['site_address'] ?? 'Risstih Road, VelCore, FY 37028' }}</p>
          <p class="mt-2 text-sm text-gray-500">Support information</p>
          <p class="font-medium text-black">
            @if(!empty($siteSettings['site_email']))
                <a href="mailto:{{ $siteSettings['site_email'] }}">{{ $siteSettings['site_email'] }}</a>
            @else
                wmvent@vmcore.com
            @endif
          </p>
        </address>
      </div>
    </div>
    
    <div class="pt-8 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
      <p class="text-sm text-gray-500">Copyright &copy; {{ date('Y') }} {{ $siteSettings['site_name'] ?? 'VM CORE' }}</p>
      <button 
        onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="w-10 h-10 bg-white rounded-sm flex items-center justify-center shadow-sm hover:shadow-md transition-shadow"
      >
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m18 15-6-6-6 6"/></svg>
      </button>
    </div>
  </div>
</footer>
