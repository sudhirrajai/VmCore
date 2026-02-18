<!--==============================
    Footer Area
==============================-->
<footer class="footer-wrapper footer-layout2 bg-white overflow-hidden">
    <div class="container">
        <div class="widget-area space-top">
            <div class="row justify-content-between">
                <div class="col-md-6 col-xl-5 col-lg-6">
                    <div class="widget widget-newsletter footer-widget">
                        <h3 class="widget_title">Get valuable strategy, culture and brand insights straight to your inbox
                        </h3>
                        <form class="newsletter-form">
                            <div class="form-group">
                                <input class="form-control" type="email" placeholder="Your email here" required="">
                            </div>
                            <button type="submit" class="btn"><img
                                    src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt=""></button>
                        </form>
                        <p>By signing up to receive emails from VMCore, you agree to our Privacy Policy. We treat your
                            info responsibly.</p>
                    </div>
                </div>
                <div class="col-md-3 col-xl-2 col-lg-3">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Links</h3>
                        <div class="menu-all-pages-container list-column2">
                            <ul class="menu">
                                <li><a href="{{ url('/about') }}">About</a></li>
                                <li><a href="{{ url('/portfolio') }}">Portfolios</a></li>
                                <li><a href="{{ url('/services') }}">Services</a></li>
                                <li><a href="{{ url('/contact') }}">Contact</a></li>
                                <li><a href="{{ url('/blog') }}">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto col-lg-4">
                    <div class="widget footer-widget widget-contact">
                        <h3 class="widget_title">Contact</h3>
                        <ul class="contact-info-list">
                            <li>27 Division St, New York, <br> NY 10002, USA</li>
                            <li>
                                <a href="tel:1800123654987">+1 800 123 654 987</a>
                                <a href="mailto:support@vmcore.in">support@vmcore.in</a>
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
                        <a href="{{ url('/') }}">VMCore</a>
                    </p>
                </div>
                <div class="col-md-6 align-self-center">
                    <div class="social-btn style3 justify-content-md-end">
                        <a href="https://www.facebook.com/">
                            <span class="link-effect">
                                <span class="effect-1"><i class="fab fa-facebook"></i></span>
                                <span class="effect-1"><i class="fab fa-facebook"></i></span>
                            </span>
                        </a>
                        <a href="https://instagram.com/">
                            <span class="link-effect">
                                <span class="effect-1"><i class="fab fa-instagram"></i></span>
                                <span class="effect-1"><i class="fab fa-instagram"></i></span>
                            </span>
                        </a>
                        <a href="https://twitter.com/">
                            <span class="link-effect">
                                <span class="effect-1"><i class="fab fa-twitter"></i></span>
                                <span class="effect-1"><i class="fab fa-twitter"></i></span>
                            </span>
                        </a>
                        <a href="https://dribbble.com/">
                            <span class="link-effect">
                                <span class="effect-1"><i class="fab fa-dribbble"></i></span>
                                <span class="effect-1"><i class="fab fa-dribbble"></i></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
