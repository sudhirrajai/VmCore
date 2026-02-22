<!--==============================
    Footer Area
==============================-->
<footer class="footer-wrapper footer-layout2 bg-white overflow-hidden">
    <div class="container">
        <div class="widget-area space-top">
            <div class="row justify-content-between">
                <div class="col-md-6 col-xl-5 col-lg-6">
                    <div class="widget widget-newsletter footer-widget">
                        <h3 class="widget_title">Get valuable strategy, culture and brand insights straight to your
                            inbox
                        </h3>
                        <form class="newsletter-form" id="newsletter-form">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" placeholder="Your email here"
                                    required="">
                            </div>
                            <button type="submit" class="btn"><img
                                    src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt=""></button>
                        </form>
                        <p id="newsletter-message" style="display:none;" class="text-success mt-2"></p>
                        <p>By signing up to receive emails from {{ $siteSettings['site_name'] ?? 'VMCore' }}, you agree
                            to our Privacy Policy. We treat your
                            info responsibly.</p>
                    </div>
                </div>
                <div class="col-md-3 col-xl-2 col-lg-3">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Links</h3>
                        <div class="menu-all-pages-container list-column2">
                            <ul class="menu">
                                @if(isset($footerMenu) && $footerMenu->count() > 0)
                                    @foreach($footerMenu as $item)
                                        @php
                                            $url = $item->page_id ? url($item->page->slug) : ($item->custom_url ?: '#');
                                        @endphp
                                        <li><a href="{{ $url }}" target="{{ $item->target }}">{{ $item->title }}</a></li>
                                    @endforeach
                                @else
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto col-lg-4">
                    <div class="widget footer-widget widget-contact">
                        <h3 class="widget_title">Contact</h3>
                        <ul class="contact-info-list">
                            @if(!empty($siteSettings['site_address']))
                                <li>{!! nl2br(e($siteSettings['site_address'])) !!}</li>
                            @endif
                            <li>
                                @if(!empty($siteSettings['site_phone']))
                                    <a
                                        href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['site_phone']) }}">{{ $siteSettings['site_phone'] }}</a>
                                @endif
                                @if(!empty($siteSettings['site_email']))
                                    <a href="mailto:{{ $siteSettings['site_email'] }}">{{ $siteSettings['site_email'] }}</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright-wrap">
            <div class="row gy-3 justify-content-between align-items-center">
                <div class="col-md-6">
                    <p class="copyright-text">Copyright &copy; {{ date('Y') }}
                        <a href="{{ url('/') }}">{{ $siteSettings['site_name'] ?? 'VMCore' }}</a>
                    </p>
                </div>
                <div class="col-md-6 align-self-center">
                    <div class="social-btn style3 justify-content-md-end">
                        @foreach(($socialLinks ?? []) as $link)
                            <a href="{{ $link->url }}" target="_blank">
                                <span class="link-effect">
                                    <span class="effect-1"><i class="{{ $link->icon_class }}"></i></span>
                                    <span class="effect-1"><i class="{{ $link->icon_class }}"></i></span>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@push('scripts')
    <script>
        document.getElementById('newsletter-form')?.addEventListener('submit', function (e) {
            e.preventDefault();
            const form = this;
            const msg = document.getElementById('newsletter-message');
            fetch('{{ route("newsletter.subscribe") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': form.querySelector('[name=_token]').value,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email: form.querySelector('[name=email]').value })
            })
                .then(r => r.json())
                .then(data => {
                    msg.style.display = 'block';
                    msg.className = 'mt-2 ' + (data.success ? 'text-success' : 'text-danger');
                    msg.textContent = data.message || (data.errors?.email?.[0] ?? 'Something went wrong');
                    if (data.success) form.reset();
                })
                .catch(() => {
                    msg.style.display = 'block';
                    msg.className = 'mt-2 text-danger';
                    msg.textContent = 'Something went wrong. Please try again.';
                });
        });
    </script>
@endpush