@if(!request()->routeIs('contact'))
  <!-- CTA Section -->
  <section class="py-24 w-full animate-on-scroll" aria-label="Call to Action">
    <div
      class="container-custom bg-card p-10 md:p-16 lg:p-20 rounded-sm border border-slate-100 shadow-[0_4px_30px_rgba(0,0,0,0.03)] flex flex-col lg:flex-row gap-12 items-center">
      <div class="w-full" style="width:75%; margin-left:5%">
        <div class="flex flex-col gap-4 lg:gap-6 w-full">
          <div class="text-left">
            <h2 class="text-4xl lg:text-6xl font-bold leading-tight text-slate-900 uppercase">
              {!! setting('cta_heading', "Let's Create Something Great") !!}
            </h2>
          </div>
          <div class="text-left max-w-4xl">
            <p class="text-base lg:text-lg leading-relaxed text-slate-500">
              {!! setting('cta_description', "We are a digital agency that helps build immersive and engaging user experiences that drive results. Our team of experts is dedicated to pushing the boundaries of what's possible.") !!}
            </p>
          </div>
        </div>
      </div>
      <div class="w-full flex justify-center" style="width:25%;margin-right:5%">
        <a href="{{ route('contact') }}"
          class="footer-cta-btn inline-flex items-center gap-6 text-white rounded-sm text-sm font-bold tracking-widest uppercase transition-all shadow-xl group text-center justify-center whitespace-nowrap"
          style="padding: 20px 48px; background-color: var(--theme-color, #000000);">
          {!! setting('cta_button_text', "LET'S TALK WITH US") !!}
        </a>
        <style>
          .footer-cta-btn:hover {
            filter: brightness(0.92);
            box-shadow: 0 5px 20px color-mix(in srgb, var(--theme-color, #4A76B2) 40%, transparent) !important;
            transform: translateY(-1px);
          }
        </style>
      </div>
    </div>
  </section>
@endif

<footer class="bg-footer py-12" role="contentinfo">
  <div class="container-custom">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">
      <div class="col-span-1 md:col-span-5">
        <h4 class="font-semibold text-lg uppercase tracking-widest mb-6 text-slate-900">
          {!! setting('footer_newsletter_title', 'Newsletter Subscription') !!}
        </h4>
        <form id="footerNewsletterForm" action="{{ route('newsletter.subscribe') }}" method="POST" class="relative"
          aria-label="Newsletter subscription">
          @csrf
          <!-- <label for="newsletter-email" class="sr-only">Email address</label> -->
          <input id="newsletter-email" name="email" placeholder="Your email here"
            class="w-full bg-white border border-transparent px-6 py-5 pr-16 rounded-sm text-base focus:ring-1 focus:ring-[#4A76B2] transition-all hover:shadow-lg hover:border-slate-200 outline-none"
            type="email" required autocomplete="email" />
          <button type="submit"
            class="absolute right-6 top-1/2 -translate-y-1/2 text-gray-400 hover:text-black transition-all hover:scale-110 active:scale-95"
            aria-label="Subscribe to newsletter">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="w-6 h-6 hover:text-[var(--theme-color,#4A76B2)] transition-colors">
              <path d="m22 2-7 20-4-9-9-4Z" />
              <path d="M22 2 11 13" />
            </svg>
          </button>
        </form>
        <p id="footer-newsletter-message" style="display:none;" class="mt-3 text-sm font-medium"></p>
        <p class="text-sm text-slate-500 mt-4 leading-relaxed">
          {!! setting('footer_newsletter_disclaimer', 'You can unsubscribe at any time and your data is protected by our privacy policy.') !!}
        </p>
        
        @if(setting('google_verification_enabled', '0') == '1')
          <p class="text-xs text-slate-400 mt-2">
            This site is protected by reCAPTCHA and the Google 
            <a href="https://policies.google.com/privacy" target="_blank" class="hover:text-black hover:underline">Privacy Policy</a> and 
            <a href="https://policies.google.com/terms" target="_blank" class="hover:text-black hover:underline">Terms of Service</a> apply.
          </p>
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

                  var form = document.getElementById('footerNewsletterForm');
                  if (form) {
                      form.addEventListener('focusin', loadRecaptcha);
                      form.addEventListener('mouseenter', loadRecaptcha);
                      
                      form.addEventListener('submit', function(e) {
                          e.preventDefault();
                          var emailInput = form.querySelector('input[name="email"]');
                          var submitBtn = form.querySelector('button[type="submit"]');
                          
                          if (submitBtn) {
                              submitBtn.disabled = true;
                              submitBtn.style.opacity = '0.5';
                          }
                          
                          loadRecaptcha();
                          var checkInterval = setInterval(function() {
                              if (typeof grecaptcha !== 'undefined' && grecaptcha.execute) {
                                  clearInterval(checkInterval);
                                  grecaptcha.ready(function() {
                                      grecaptcha.execute('{{ setting('google_recaptcha_site_key') }}', {action: 'newsletter_subscribe'}).then(function(token) {
                                          var input = form.querySelector('input[name="g-recaptcha-response"]');
                                          if (!input) {
                                              input = document.createElement('input');
                                              input.type = 'hidden';
                                              input.name = 'g-recaptcha-response';
                                              form.appendChild(input);
                                          }
                                          input.value = token;
                                          
                                          fetch(form.action, {
                                              method: 'POST',
                                              body: new FormData(form),
                                              headers: {
                                                  'Accept': 'application/json, text/plain, */*',
                                                  'X-Requested-With': 'XMLHttpRequest'
                                              }
                                          }).then(r => r.json()).then(data => {
                                              var msg = document.getElementById('footer-newsletter-message');
                                              msg.style.display = 'block';
                                              msg.className = 'mt-3 text-sm font-medium ' + (data.success ? 'text-green-600' : 'text-red-500');
                                              msg.textContent = data.message || (data.errors?.email?.[0] ?? (data.success ? 'Subscribed successfully!' : 'Error occurred.'));
                                              if(data.success) {
                                                  emailInput.value = '';
                                              }
                                          }).catch(err => {
                                              var msg = document.getElementById('footer-newsletter-message');
                                              msg.style.display = 'block';
                                              msg.className = 'mt-3 text-sm font-medium text-red-500';
                                              msg.textContent = 'Something went wrong. Please try again.';
                                          }).finally(() => {
                                              if (submitBtn) {
                                                  submitBtn.disabled = false;
                                                  submitBtn.style.opacity = '1';
                                              }
                                          });
                                      });
                                  });
                              }
                          }, 100);
                      });
                  }
              });
          </script>
        @else
          {{-- Newsletter form Ajax submission without Captcha --}}
          <script>
            document.addEventListener('DOMContentLoaded', function() {
                var form = document.getElementById('footerNewsletterForm');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        var emailInput = form.querySelector('input[name="email"]');
                        var submitBtn = form.querySelector('button[type="submit"]');
                        if(submitBtn) { submitBtn.disabled = true; submitBtn.style.opacity = '0.5'; }
                        fetch(form.action, {
                            method: 'POST',
                            body: new FormData(form),
                            headers: { 
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest' 
                            }
                        }).then(r => r.json()).then(data => {
                            var msg = document.getElementById('footer-newsletter-message');
                            msg.style.display = 'block';
                            msg.className = 'mt-3 text-sm font-medium ' + (data.success ? 'text-green-600' : 'text-red-500');
                            msg.textContent = data.message || (data.errors?.email?.[0] ?? (data.success ? 'Subscribed successfully!' : 'Error occurred.'));
                            if(data.success) {
                                emailInput.value = '';
                            }
                        }).catch(err => {
                            var msg = document.getElementById('footer-newsletter-message');
                            msg.style.display = 'block';
                            msg.className = 'mt-3 text-sm font-medium text-red-500';
                            msg.textContent = 'Something went wrong. Please try again.';
                        }).finally(() => {
                            if (submitBtn) { submitBtn.disabled = false; submitBtn.style.opacity = '1'; }
                        });
                    });
                }
            });
          </script>
        @endif
      </div>

      <nav class="md:col-span-2" aria-label="Footer navigation">
        <h4 class="font-semibold text-lg uppercase tracking-widest mb-4 text-slate-900">{!! setting('footer_links_title', 'Links') !!}</h4>
        <ul class="space-y-2 text-base text-slate-500">
          @if(isset($footerMenu) && $footerMenu->count() > 0)
            @foreach($footerMenu as $item)
              @php $url = $item->custom_url ?: ($item->page ? url($item->page->slug) : '#'); @endphp
              <li><a href="{{ $url }}" target="{{ $item->target ?? '_self' }}" class="hover:text-black">{{ $item->title }}</a></li>
            @endforeach
          @else
            <li><a href="{{ route('home') }}" class="hover:text-black">Home</a></li>
            @if(setting('show_about_page', 1))
              <li><a href="{{ route('about') }}" class="hover:text-black">About</a></li>
            @endif
            @if(setting('show_services_page', 1))
              <li><a href="{{ route('services') }}" class="hover:text-black">Services</a></li>
            @endif
            @if(setting('show_portfolio_page', 1))
              <li><a href="{{ route('portfolio') }}" class="hover:text-black">Portfolio</a></li>
            @endif
            @if(setting('show_blog_page', 1))
              <li><a href="{{ route('blog') }}" class="hover:text-black">Blog</a></li>
            @endif
            @if(setting('show_faq_page', 1))
              <li><a href="{{ route('faq') }}" class="hover:text-black">FAQ</a></li>
            @endif
            @if(setting('show_contact_page', 1))
              <li><a href="{{ route('contact') }}" class="hover:text-black">Contact</a></li>
            @endif
          @endif
        </ul>
      </nav>

      <div class="md:col-span-2">
        <h4 class="font-semibold text-lg uppercase tracking-widest mb-4 text-slate-900">{!! setting('footer_services_title', 'Services') !!}</h4>
        <ul class="space-y-2 text-base text-slate-500">
          @php $footerServices = \App\Models\Service::where('status', true)->orderBy('order')->take(4)->get(); @endphp
          @forelse($footerServices as $footerService)
            <li><a href="{{ route('service.detail', $footerService->slug) }}"
                class="hover:text-black">{{ $footerService->title }}</a></li>
          @empty
            <li><a href="{{ route('services') }}" class="hover:text-black">Branding</a></li>
            <li><a href="{{ route('services') }}" class="hover:text-black">Graphic Design</a></li>
            <li><a href="{{ route('services') }}" class="hover:text-black">Web Development</a></li>
          @endforelse
          @if(setting('show_contact_page', 1))
            <li><a href="{{ route('contact') }}" class="hover:text-black">Contact</a></li>
          @endif
        </ul>
      </div>

      <div class="md:col-span-3">
        <h4 class="font-semibold text-lg uppercase tracking-widest mb-4 text-slate-900">{!! setting('footer_contact_title', 'Contact') !!}</h4>
        <div class="flex space-x-4 mb-4">
          @if(isset($socialLinks) && $socialLinks->count() > 0)
            @foreach($socialLinks as $social)
              <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer"
                class="cursor-pointer hover:opacity-60 text-slate-500"
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
          @else
            {{-- Fallback social icons with no links when admin hasn't configured --}}
            <span class="cursor-default text-gray-400"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="w-5 h-5">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
              </svg></span>
            <span class="cursor-default text-gray-400"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="w-5 h-5">
                <path
                  d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z" />
              </svg></span>
            <span class="cursor-default text-gray-400"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="w-5 h-5">
                <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
              </svg></span>
          @endif
        </div>
        <address class="not-italic text-base text-slate-500 space-y-1">
          <p>Address: {{ $siteSettings['site_address'] ?? setting('address', 'Risstih Road, VelCore, FY 37028') }}</p>
          <p class="mt-2 text-sm text-slate-400">{!! setting('footer_support_label', 'Support information') !!}</p>
          <p class="font-medium text-slate-900">
            @if(!empty($siteSettings['site_email']))
              <a href="mailto:{{ $siteSettings['site_email'] }}">{{ $siteSettings['site_email'] }}</a>
            @else
              <a href="mailto:{{ setting('contact_email', 'info@vmcore.com') }}">{{ setting('contact_email',
                'info@vmcore.com') }}</a>
            @endif
          </p>
        </address>
      </div>
    </div>

    <div
      class="pt-8 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4 bg-transparent">
      <div class="container-custom flex flex-col md:flex-row justify-between items-center w-full gap-4 px-0">
        <p class="text-sm text-gray-500">Copyright &copy; {{ date('Y') }} {{ $siteSettings['site_name'] ?? 'VM CORE' }}.
          All rights reserved.</p>
        <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
          class="w-10 h-10 bg-white rounded-sm flex items-center justify-center shadow-sm hover:shadow-md transition-shadow"
          aria-label="Scroll to top">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
            <path d="m18 15-6-6-6 6" />
          </svg>
        </button>
      </div>
    </div>
</footer>