@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Frontend Content Settings')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Frontend Content</h4>

    <form action="{{ route('admin.settings.frontend.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 mb-4">
                <div class="accordion" id="settingsAccordion">

                    {{-- 1. GLOBAL & FOOTER --}}
                    <div class="accordion-item card">
                        <h2 class="accordion-header" id="headingGlobal">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseGlobal">
                                <i class="bx bx-globe me-2"></i> 1. Global, Navigation & Footer
                            </button>
                        </h2>
                        <div id="collapseGlobal" class="accordion-collapse collapse" data-bs-parent="#settingsAccordion">
                            <div class="accordion-body rounded p-4 border-top">
                                <h6 class="fw-bold mb-3 text-uppercase text-primary">Navbar & Global Texts</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Navbar CTA Button Text</label>
                                        <input type="text" class="form-control" name="navbar_cta_text"
                                            value="{{ $settings['navbar_cta_text'] ?? 'WORK WITH US' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Marquee / Ticker Text</label>
                                        <input type="text" class="form-control" name="marquee_text"
                                            value="{{ $settings['marquee_text'] ?? '' }}">
                                        <small class="text-muted">Scrolling marquee text shown on blog, team pages
                                            etc.</small>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Footer CTA Section</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">CTA Heading</label>
                                        <input type="text" class="form-control" name="cta_heading"
                                            value="{{ $settings['cta_heading'] ?? "Let's Create Something Great" }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">CTA Button Text</label>
                                        <input type="text" class="form-control" name="cta_button_text"
                                            value="{{ $settings['cta_button_text'] ?? "LET'S TALK WITH US" }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">CTA Description</label>
                                    <textarea class="form-control" name="cta_description"
                                        rows="2">{{ $settings['cta_description'] ?? "We are a digital agency that helps build immersive and engaging user experiences that drive results." }}</textarea>
                                </div>
                                <hr>
                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Footer Columns</h6>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Newsletter Title</label>
                                        <input type="text" class="form-control" name="footer_newsletter_title"
                                            value="{{ $settings['footer_newsletter_title'] ?? 'Newsletter Subscription' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Links Title</label>
                                        <input type="text" class="form-control" name="footer_links_title"
                                            value="{{ $settings['footer_links_title'] ?? 'Links' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Services Title</label>
                                        <input type="text" class="form-control" name="footer_services_title"
                                            value="{{ $settings['footer_services_title'] ?? 'Services' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Contact Title</label>
                                        <input type="text" class="form-control" name="footer_contact_title"
                                            value="{{ $settings['footer_contact_title'] ?? 'Contact' }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Support Label</label>
                                        <input type="text" class="form-control" name="footer_support_label"
                                            value="{{ $settings['footer_support_label'] ?? 'Support information' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Newsletter Disclaimer</label>
                                        <input type="text" class="form-control" name="footer_newsletter_disclaimer"
                                            value="{{ $settings['footer_newsletter_disclaimer'] ?? 'You can unsubscribe at any time and your data is protected by our privacy policy.' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2. HOME PAGE --}}
                    <div class="accordion-item card">
                        <h2 class="accordion-header" id="headingHome">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseHome">
                                <i class="bx bx-home me-2"></i> 2. Home Page
                            </button>
                        </h2>
                        <div id="collapseHome" class="accordion-collapse collapse" data-bs-parent="#settingsAccordion">
                            <div class="accordion-body  rounded p-4 border-top">
                                <h6 class="fw-bold mb-3 text-uppercase text-primary">Hero Fallback Content</h6>
                                <div class="mb-3">
                                    <label class="form-label">Hero Fallback Title</label>
                                    <input type="text" class="form-control" name="home_hero_fallback_title"
                                        value="{{ $settings['home_hero_fallback_title'] ?? 'WE MAKE <br /> CREATIVE THINGS <br /> EVERYDAY' }}">
                                    <small class="text-muted">Shown when no hero slider is set. Supports HTML labels like
                                        &lt;br&gt;.</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Hero Fallback Description</label>
                                    <textarea class="form-control" name="home_hero_fallback_description"
                                        rows="2">{{ $settings['home_hero_fallback_description'] ?? 'We are a digital agency that helps build immersive and engaging user experiences that drive results.' }}</textarea>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Hero Button Text</label>
                                        <input type="text" class="form-control" name="home_hero_button_text"
                                            value="{{ $settings['home_hero_button_text'] ?? 'VIEW OUR WORKS' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Service Card Link Text</label>
                                        <input type="text" class="form-control" name="home_service_link_text"
                                            value="{{ $settings['home_service_link_text'] ?? 'VIEW DETAILS' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Project Overlay Text</label>
                                        <input type="text" class="form-control" name="home_project_overlay_text"
                                            value="{{ $settings['home_project_overlay_text'] ?? 'View Project' }}">
                                    </div>
                                </div>
                                <hr>
                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Section Titles</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Services Section Title</label>
                                        <input type="text" class="form-control" name="home_services_title"
                                            value="{{ $settings['home_services_title'] ?? 'What We Can Do for Our Clients' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Portfolio Section Title</label>
                                        <input type="text" class="form-control" name="home_portfolio_title"
                                            value="{{ $settings['home_portfolio_title'] ?? 'Discover Our Selected Projects' }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Blog Section Title</label>
                                        <input type="text" class="form-control" name="home_blog_title"
                                            value="{{ $settings['home_blog_title'] ?? 'Read Our Articles and News' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">CTA Section Title</label>
                                        <input type="text" class="form-control" name="home_cta_title"
                                            value="{{ $settings['home_cta_title'] ?? "Let's Create Something Great" }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Skills Section Title</label>
                                        <input type="text" class="form-control" name="home_skills_title"
                                            value="{{ $settings['home_skills_title'] ?? 'We Offer a Wide Range of Brand Services' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">CTA Section Subtitle</label>
                                        <input type="text" class="form-control" name="home_cta_subtitle"
                                            value="{{ $settings['home_cta_subtitle'] ?? "We shift you from today's reality to tomorrow's potential" }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Skills Section Subtitle</label>
                                    <textarea class="form-control" name="home_skills_subtitle"
                                        rows="2">{{ $settings['home_skills_subtitle'] ?? 'We are a creative agency working with brands building insightful strategy, creating unique designs and crafting value' }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">FAQ & Search Schema (JSON-LD)</label>
                                    <textarea class="form-control font-monospace" name="home_faq_schema" rows="4" placeholder='<script type="application/ld+json">...</script>'>{{ $settings['home_faq_schema'] ?? '' }}</textarea>
                                    <div class="form-text small">Paste JSON-LD script for the Home page here.</div>
                                </div>
                                <hr>
                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Background Images</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Skills Section — Side Image</label>
                                        <input class="form-control" type="file" name="home_skills_bg" id="hi-home_skills_bg"
                                            accept="image/*" onchange="imgPreview(this,'hp-home_skills_bg')">
                                        <div id="hp-home_skills_bg" class="mt-2 text-center" style="max-width:200px;">
                                            @if(!empty($settings['home_skills_bg']))
                                                <img src="{{ asset($settings['home_skills_bg']) }}"
                                                    class="img-fluid rounded border">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Video Section — Background</label>
                                        <input class="form-control" type="file" name="home_video_bg" id="hi-home_video_bg"
                                            accept="image/*" onchange="imgPreview(this,'hp-home_video_bg')">
                                        <div id="hp-home_video_bg" class="mt-2 text-center" style="max-width:200px;">
                                            @if(!empty($settings['home_video_bg']))
                                                <img src="{{ asset($settings['home_video_bg']) }}"
                                                    class="img-fluid rounded border">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 3. ABOUT PAGE --}}
                    <div class="accordion-item card">
                        <h2 class="accordion-header" id="headingAbout">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseAbout">
                                <i class="bx bx-info-circle me-2"></i> 3. About Page
                            </button>
                        </h2>
                        <div id="collapseAbout" class="accordion-collapse collapse" data-bs-parent="#settingsAccordion">
                            <div class="accordion-body  rounded p-4 border-top">
                                <div
                                    class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded border">
                                    <p class="mb-0 fw-semibold text-dark"><i class="bx bx-show-alt me-1"></i> Page
                                        Visibility Status</p>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input page-toggle fs-4" type="checkbox" role="switch"
                                            name="show_about_page" id="show_about_page" {{ ($settings['show_about_page'] ?? 1) ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Page Header & Intro</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Hero / Breadcrumb Image</label>
                                        <input class="form-control" type="file" name="about_hero_image"
                                            id="hi-about_hero_image" accept="image/*"
                                            onchange="imgPreview(this,'hp-about_hero_image')">
                                        <div id="hp-about_hero_image" class="mt-2" style="max-width:340px;">
                                            @if(!empty($settings['about_hero_image']))
                                                <img src="{{ asset($settings['about_hero_image']) }}"
                                                    class="img-fluid rounded border"
                                                    style="max-height:100px; width:100%; object-fit:cover;">
                                            @else
                                                <div class="text-muted small"><i class="bx bx-image"></i> Default:
                                                    <code>assets/img/bg/breadcumb-bg1-3.jpg</code></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Breadcrumb Title</label>
                                        <input type="text" class="form-control" name="about_breadcrumb_title"
                                            value="{{ $settings['about_breadcrumb_title'] ?? 'About Us' }}">

                                        <label class="form-label fw-semibold mt-3">Meta Description</label>
                                        <textarea class="form-control" name="about_meta_description"
                                            rows="2">{{ $settings['about_meta_description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Intro Section — Main Title</label>
                                        <input type="text" class="form-control" name="about_intro_title"
                                            value="{{ $settings['about_intro_title'] ?? 'We Are Creative Digital Agency' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Intro Section — Description</label>
                                        <textarea class="form-control" name="about_intro_description"
                                            rows="2">{{ $settings['about_intro_description'] ?? '' }}</textarea>
                                    </div>
                                </div>

                                <hr>
                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Company Statistics</h6>
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <label class="form-label">Stat 1 Value</label>
                                        <input type="text" class="form-control" name="about_stat_1_value"
                                            value="{{ $settings['about_stat_1_value'] ?? '50+' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Stat 1 Label</label>
                                        <input type="text" class="form-control" name="about_stat_1_label"
                                            value="{{ $settings['about_stat_1_label'] ?? 'Projects Delivered' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Stat 2 Value</label>
                                        <input type="text" class="form-control" name="about_stat_2_value"
                                            value="{{ $settings['about_stat_2_value'] ?? '5+' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Stat 2 Label</label>
                                        <input type="text" class="form-control" name="about_stat_2_label"
                                            value="{{ $settings['about_stat_2_label'] ?? 'Years of Experience' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Stat 3 Value</label>
                                        <input type="text" class="form-control" name="about_stat_3_value"
                                            value="{{ $settings['about_stat_3_value'] ?? '98%' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Stat 3 Label</label>
                                        <input type="text" class="form-control" name="about_stat_3_label"
                                            value="{{ $settings['about_stat_3_label'] ?? 'Client Satisfaction' }}">
                                    </div>
                                </div>

                                <hr>
                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Page Content Labels</h6>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Our Expertise Title</label>
                                        <input type="text" class="form-control" name="about_skills_title"
                                            value="{{ $settings['about_skills_title'] ?? 'Our Expertise' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Team Section Title</label>
                                        <input type="text" class="form-control" name="about_team_title"
                                            value="{{ $settings['about_team_title'] ?? 'Meet Our Creative Team' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Awards Section Title</label>
                                        <input type="text" class="form-control" name="about_awards_title"
                                            value="{{ $settings['about_awards_title'] ?? 'Awards & Recognition' }}">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">Testimonials Section Title</label>
                                        <input type="text" class="form-control" name="about_testimonials_title"
                                            value="{{ $settings['about_testimonials_title'] ?? 'What Our Clients Say' }}">
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">Clients Section Title</label>
                                        <input type="text" class="form-control" name="about_clients_title"
                                            value="{{ $settings['about_clients_title'] ?? 'Our Clients' }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label">About Section — Side Image</label>
                                    <input class="form-control" type="file" name="about_side_image" id="hi-about_side_image"
                                        accept="image/*" onchange="imgPreview(this,'hp-about_side_image')">
                                    <div id="hp-about_side_image" class="mt-2" style="max-width:200px;">
                                        @if(!empty($settings['about_side_image']))
                                            <img src="{{ asset($settings['about_side_image']) }}"
                                                class="img-fluid rounded border">
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">FAQ & Search Schema (JSON-LD)</label>
                                    <textarea class="form-control font-monospace" name="about_faq_schema" rows="4" placeholder='<script type="application/ld+json">...</script>'>{{ $settings['about_faq_schema'] ?? '' }}</textarea>
                                    <div class="form-text small">Paste JSON-LD script for the About page here.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 4. SERVICES & PROCESS --}}
                    <div class="accordion-item card">
                        <h2 class="accordion-header" id="headingServices">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseServices">
                                <i class="bx bx-briefcase me-2"></i> 4. Services & Process
                            </button>
                        </h2>
                        <div id="collapseServices" class="accordion-collapse collapse" data-bs-parent="#settingsAccordion">
                            <div class="accordion-body  rounded p-4 border-top">
                                <div
                                    class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded border">
                                    <p class="mb-0 fw-semibold text-dark"><i class="bx bx-show-alt me-1"></i> Page
                                        Visibility Status</p>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input page-toggle fs-4" type="checkbox" role="switch"
                                            name="show_services_page" id="show_services_page" {{ ($settings['show_services_page'] ?? 1) ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Page Header & Intro</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Services Hub — Hero / Breadcrumb Image</label>
                                        <input class="form-control" type="file" name="services_hero_image"
                                            id="hi-services_hero_image" accept="image/*"
                                            onchange="imgPreview(this,'hp-services_hero_image')">
                                        <div id="hp-services_hero_image" class="mt-2" style="max-width:340px;">
                                            @if(!empty($settings['services_hero_image']))
                                                <img src="{{ asset($settings['services_hero_image']) }}"
                                                    class="img-fluid rounded border"
                                                    style="max-height:100px; width:100%; object-fit:cover;">
                                            @else
                                                <div class="text-muted small"><i class="bx bx-image"></i> Default:
                                                    <code>assets/img/bg/breadcumb-bg1-2.jpg</code></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Breadcrumb Title</label>
                                        <input type="text" class="form-control" name="services_breadcrumb_title"
                                            value="{{ $settings['services_breadcrumb_title'] ?? 'Services' }}">

                                        <label class="form-label fw-semibold mt-3">Meta Description</label>
                                        <textarea class="form-control" name="services_meta_description"
                                            rows="2">{{ $settings['services_meta_description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Service Inner Detail Page — Hero Image</label>
                                        <input class="form-control" type="file" name="service_detail_hero_image"
                                            id="hi-service_detail_hero_image" accept="image/*"
                                            onchange="imgPreview(this,'hp-service_detail_hero_image')">
                                        <div id="hp-service_detail_hero_image" class="mt-2" style="max-width:340px;">
                                            @if(!empty($settings['service_detail_hero_image']))
                                                <img src="{{ asset($settings['service_detail_hero_image']) }}"
                                                    class="img-fluid rounded border"
                                                    style="max-height:100px; width:100%; object-fit:cover;">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Page Intro Text</label>
                                        <textarea class="form-control" name="services_page_intro"
                                            rows="2">{{ $settings['services_page_intro'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">FAQ & Search Schema (JSON-LD)</label>
                                    <textarea class="form-control font-monospace" name="services_page_faq_schema" rows="4" placeholder='<script type="application/ld+json">...</script>'>{{ $settings['services_page_faq_schema'] ?? '' }}</textarea>
                                    <div class="form-text small">Paste JSON-LD script for the Services Hub page here.</div>
                                </div>

                                <hr>
                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Service Content Elements</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Services Link Text (Card Button)</label>
                                        <input type="text" class="form-control" name="services_link_text"
                                            value="{{ $settings['services_link_text'] ?? 'VIEW DETAILS' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Service Related Projects Title</label>
                                        <input type="text" class="form-control" name="service_related_projects_title"
                                            value="{{ $settings['service_related_projects_title'] ?? 'Related Projects' }}">
                                    </div>
                                </div>

                                <hr>
                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Our Process Section</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Process Section Label</label>
                                        <input type="text" class="form-control" name="process_section_label"
                                            value="{{ $settings['process_section_label'] ?? 'How We Work' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Process Section Heading</label>
                                        <input type="text" class="form-control" name="process_section_heading"
                                            value="{{ $settings['process_section_heading'] ?? 'Our Process' }}">
                                    </div>
                                </div>
                                <div class="bg-white p-3 border rounded shadow-sm">
                                    @php
                                        $processSteps = [
                                            1 => ['title' => 'Discovery', 'desc' => 'Understanding your goals...'],
                                            2 => ['title' => 'Strategy', 'desc' => 'Crafting a data-driven roadmap...'],
                                            3 => ['title' => 'Design', 'desc' => 'Creating intuitive interfaces...'],
                                            4 => ['title' => 'Development', 'desc' => 'Building high-performance systems...'],
                                            5 => ['title' => 'QA & Testing', 'desc' => 'Rigorous testing to ensure...'],
                                            6 => ['title' => 'Launch', 'desc' => 'Deploying with precision...'],
                                        ];
                                    @endphp
                                    @foreach($processSteps as $step => $defaults)
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Step {{ $step }} Title</label>
                                                <input type="text" class="form-control" name="process_step_{{ $step }}_title"
                                                    value="{{ $settings['process_step_' . $step . '_title'] ?? $defaults['title'] }}">
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label">Step {{ $step }} Description</label>
                                                <input type="text" class="form-control"
                                                    name="process_step_{{ $step }}_description"
                                                    value="{{ $settings['process_step_' . $step . '_description'] ?? $defaults['desc'] }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 5. PORTFOLIO --}}
                    <div class="accordion-item card">
                        <h2 class="accordion-header" id="headingPortfolio">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapsePortfolio">
                                <i class="bx bx-layout me-2"></i> 5. Portfolio
                            </button>
                        </h2>
                        <div id="collapsePortfolio" class="accordion-collapse collapse" data-bs-parent="#settingsAccordion">
                            <div class="accordion-body  rounded p-4 border-top">
                                <div
                                    class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded border">
                                    <p class="mb-0 fw-semibold text-dark"><i class="bx bx-show-alt me-1"></i> Page
                                        Visibility Status</p>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input page-toggle fs-4" type="checkbox" role="switch"
                                            name="show_portfolio_page" id="show_portfolio_page" {{ ($settings['show_portfolio_page'] ?? 1) ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Page Header & Hub Options</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Portfolio Hub — Hero / Breadcrumb
                                            Image</label>
                                        <input class="form-control" type="file" name="portfolio_hero_image"
                                            id="hi-portfolio_hero_image" accept="image/*"
                                            onchange="imgPreview(this,'hp-portfolio_hero_image')">
                                        <div id="hp-portfolio_hero_image" class="mt-2" style="max-width:340px;">
                                            @if(!empty($settings['portfolio_hero_image']))
                                                <img src="{{ asset($settings['portfolio_hero_image']) }}"
                                                    class="img-fluid rounded border"
                                                    style="max-height:100px; width:100%; object-fit:cover;">
                                            @else
                                                <div class="text-muted small"><i class="bx bx-image"></i> Default:
                                                    <code>assets/img/bg/breadcumb-bg1-5.jpg</code></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Breadcrumb Title</label>
                                        <input type="text" class="form-control" name="portfolio_breadcrumb_title"
                                            value="{{ $settings['portfolio_breadcrumb_title'] ?? 'Portfolio' }}">

                                        <label class="form-label fw-semibold mt-3">Meta Description</label>
                                        <textarea class="form-control" name="portfolio_meta_description"
                                            rows="2">{{ $settings['portfolio_meta_description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Filter "All" Text</label>
                                        <input type="text" class="form-control" name="portfolio_filter_all_text"
                                            value="{{ $settings['portfolio_filter_all_text'] ?? 'All' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">View Project Button</label>
                                        <input type="text" class="form-control" name="portfolio_view_button_text"
                                            value="{{ $settings['portfolio_view_button_text'] ?? 'View Project' }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">FAQ & Search Schema (JSON-LD)</label>
                                    <textarea class="form-control font-monospace" name="portfolio_page_faq_schema" rows="4" placeholder='<script type="application/ld+json">...</script>'>{{ $settings['portfolio_page_faq_schema'] ?? '' }}</textarea>
                                    <div class="form-text small">Paste JSON-LD script for the Portfolio Hub page here.</div>
                                </div>

                                <hr>
                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Portfolio Detail Page Headings
                                </h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Project Detail Page — Hero Image</label>
                                        <input class="form-control" type="file" name="portfolio_detail_hero_image"
                                            id="hi-portfolio_detail_hero_image" accept="image/*"
                                            onchange="imgPreview(this,'hp-portfolio_detail_hero_image')">
                                        <div id="hp-portfolio_detail_hero_image" class="mt-2" style="max-width:340px;">
                                            @if(!empty($settings['portfolio_detail_hero_image']))
                                                <img src="{{ asset($settings['portfolio_detail_hero_image']) }}"
                                                    class="img-fluid rounded border"
                                                    style="max-height:100px; width:100%; object-fit:cover;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Story Title</label>
                                        <input type="text" class="form-control" name="portfolio_story_title"
                                            value="{{ $settings['portfolio_story_title'] ?? 'The Story' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Quick Facts Title</label>
                                        <input type="text" class="form-control" name="portfolio_facts_title"
                                            value="{{ $settings['portfolio_facts_title'] ?? 'Quick Facts' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Problem & Solution</label>
                                        <input type="text" class="form-control" name="portfolio_problem_title"
                                            value="{{ $settings['portfolio_problem_title'] ?? 'Problem & Solution' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Features Highlight</label>
                                        <input type="text" class="form-control" name="portfolio_features_title"
                                            value="{{ $settings['portfolio_features_title'] ?? 'Feature Highlights' }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">UI Gallery Title</label>
                                        <input type="text" class="form-control" name="portfolio_gallery_section_title"
                                            value="{{ $settings['portfolio_gallery_section_title'] ?? 'UI Gallery' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Feedback Title</label>
                                        <input type="text" class="form-control" name="portfolio_feedback_title"
                                            value="{{ $settings['portfolio_feedback_title'] ?? 'Client Feedback' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Visit Button Text</label>
                                        <input type="text" class="form-control" name="portfolio_visit_button_text"
                                            value="{{ $settings['portfolio_visit_button_text'] ?? 'Visit Project' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Related Section Label</label>
                                        <input type="text" class="form-control" name="portfolio_related_label"
                                            value="{{ $settings['portfolio_related_label'] ?? 'Projects' }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Related Work Heading</label>
                                        <input type="text" class="form-control" name="portfolio_related_heading"
                                            value="{{ $settings['portfolio_related_heading'] ?? 'Discover Related Work' }}">
                                    </div>
                                </div>
                                <hr>
                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Quick Facts Labels</h6>
                                <div class="row mb-3">
                                    <div class="col-md-2 col-sm-4">
                                        <label class="form-label">Client</label>
                                        <input type="text" class="form-control" name="portfolio_fact_client_label"
                                            value="{{ $settings['portfolio_fact_client_label'] ?? 'Client' }}">
                                    </div>
                                    <div class="col-md-2 col-sm-4">
                                        <label class="form-label">Industry</label>
                                        <input type="text" class="form-control" name="portfolio_fact_industry_label"
                                            value="{{ $settings['portfolio_fact_industry_label'] ?? 'Industry' }}">
                                    </div>
                                    <div class="col-md-2 col-sm-4">
                                        <label class="form-label">Tech</label>
                                        <input type="text" class="form-control" name="portfolio_fact_tech_label"
                                            value="{{ $settings['portfolio_fact_tech_label'] ?? 'Tech' }}">
                                    </div>
                                    <div class="col-md-2 col-sm-4">
                                        <label class="form-label">Services</label>
                                        <input type="text" class="form-control" name="portfolio_fact_services_label"
                                            value="{{ $settings['portfolio_fact_services_label'] ?? 'Services' }}">
                                    </div>
                                    <div class="col-md-2 col-sm-6">
                                        <label class="form-label">Date</label>
                                        <input type="text" class="form-control" name="portfolio_fact_date_label"
                                            value="{{ $settings['portfolio_fact_date_label'] ?? 'Date' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 6. BLOG --}}
                    <div class="accordion-item card">
                        <h2 class="accordion-header" id="headingBlog">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseBlog">
                                <i class="bx bx-news me-2"></i> 6. Blog
                            </button>
                        </h2>
                        <div id="collapseBlog" class="accordion-collapse collapse" data-bs-parent="#settingsAccordion">
                            <div class="accordion-body  rounded p-4 border-top">
                                <div
                                    class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded border">
                                    <p class="mb-0 fw-semibold text-dark"><i class="bx bx-show-alt me-1"></i> Page
                                        Visibility Status</p>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input page-toggle fs-4" type="checkbox" role="switch"
                                            name="show_blog_page" id="show_blog_page" {{ ($settings['show_blog_page'] ?? 1) ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Page Header</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Hero / Breadcrumb Image</label>
                                        <input class="form-control" type="file" name="blog_hero_image"
                                            id="hi-blog_hero_image" accept="image/*"
                                            onchange="imgPreview(this,'hp-blog_hero_image')">
                                        <div id="hp-blog_hero_image" class="mt-2" style="max-width:340px;">
                                            @if(!empty($settings['blog_hero_image']))
                                                <img src="{{ asset($settings['blog_hero_image']) }}"
                                                    class="img-fluid rounded border"
                                                    style="max-height:100px; width:100%; object-fit:cover;">
                                            @else
                                                <div class="text-muted small"><i class="bx bx-image"></i> Default:
                                                    <code>assets/img/bg/breadcumb-bg1-8.jpg</code></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Breadcrumb Title</label>
                                        <input type="text" class="form-control" name="blog_breadcrumb_title"
                                            value="{{ $settings['blog_breadcrumb_title'] ?? 'Blog' }}">

                                        <label class="form-label fw-semibold mt-3">Meta Description</label>
                                        <textarea class="form-control" name="blog_meta_description"
                                            rows="2">{{ $settings['blog_meta_description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <hr>
                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Blog Labels & Sidebar</h6>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Read More Text</label>
                                        <input type="text" class="form-control" name="blog_read_more_text"
                                            value="{{ $settings['blog_read_more_text'] ?? 'READ MORE' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Tags Label</label>
                                        <input type="text" class="form-control" name="blog_tags_label"
                                            value="{{ $settings['blog_tags_label'] ?? 'Tags:' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Related Posts Title</label>
                                        <input type="text" class="form-control" name="blog_related_title"
                                            value="{{ $settings['blog_related_title'] ?? 'Related Posts' }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Categories Sidebar Title</label>
                                        <input type="text" class="form-control" name="sidebar_categories_title"
                                            value="{{ $settings['sidebar_categories_title'] ?? 'Categories' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Recent Posts Sidebar Title</label>
                                        <input type="text" class="form-control" name="sidebar_recent_posts_title"
                                            value="{{ $settings['sidebar_recent_posts_title'] ?? 'Recent Posts' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Tags Sidebar Title</label>
                                        <input type="text" class="form-control" name="sidebar_tags_title"
                                            value="{{ $settings['sidebar_tags_title'] ?? 'Tags' }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">FAQ & Search Schema (JSON-LD)</label>
                                    <textarea class="form-control font-monospace" name="blog_page_faq_schema" rows="4" placeholder='<script type="application/ld+json">...</script>'>{{ $settings['blog_page_faq_schema'] ?? '' }}</textarea>
                                    <div class="form-text small">Paste JSON-LD script for the Blog Hub page here.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 7. TEAM --}}
                    <div class="accordion-item card">
                        <h2 class="accordion-header" id="headingTeam">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTeam">
                                <i class="bx bx-group me-2"></i> 7. Team
                            </button>
                        </h2>
                        <div id="collapseTeam" class="accordion-collapse collapse" data-bs-parent="#settingsAccordion">
                            <div class="accordion-body  rounded p-4 border-top">
                                <div
                                    class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded border">
                                    <p class="mb-0 fw-semibold text-dark"><i class="bx bx-show-alt me-1"></i> Page
                                        Visibility Status</p>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input page-toggle fs-4" type="checkbox" role="switch"
                                            name="show_team_page" id="show_team_page" {{ ($settings['show_team_page'] ?? 1) ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Page Header</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Hero / Breadcrumb Image</label>
                                        <input class="form-control" type="file" name="team_hero_image"
                                            id="hi-team_hero_image" accept="image/*"
                                            onchange="imgPreview(this,'hp-team_hero_image')">
                                        <div id="hp-team_hero_image" class="mt-2" style="max-width:340px;">
                                            @if(!empty($settings['team_hero_image']))
                                                <img src="{{ asset($settings['team_hero_image']) }}"
                                                    class="img-fluid rounded border"
                                                    style="max-height:100px; width:100%; object-fit:cover;">
                                            @else
                                                <div class="text-muted small"><i class="bx bx-image"></i> Default:
                                                    <code>assets/img/bg/breadcumb-bg1-4.jpg</code></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Breadcrumb Title</label>
                                        <input type="text" class="form-control" name="team_breadcrumb_title"
                                            value="{{ $settings['team_breadcrumb_title'] ?? 'Our Team' }}">

                                        <label class="form-label fw-semibold mt-3">Meta Description</label>
                                        <textarea class="form-control" name="team_meta_description"
                                            rows="2">{{ $settings['team_meta_description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Page Intro Text</label>
                                    <textarea class="form-control" name="team_page_intro"
                                        rows="2">{{ $settings['team_page_intro'] ?? '' }}</textarea>
                                </div>

                                <hr>
                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Detail Page Labels</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Contact Info Title</label>
                                        <input type="text" class="form-control" name="team_contact_info_title"
                                            value="{{ $settings['team_contact_info_title'] ?? 'Contact Info' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Testimonials Title</label>
                                        <input type="text" class="form-control" name="team_testimonials_title"
                                            value="{{ $settings['team_testimonials_title'] ?? 'What Clients Say' }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">FAQ & Search Schema (JSON-LD)</label>
                                    <textarea class="form-control font-monospace" name="team_page_faq_schema" rows="4" placeholder='<script type="application/ld+json">...</script>'>{{ $settings['team_page_faq_schema'] ?? '' }}</textarea>
                                    <div class="form-text small">Paste JSON-LD script for the Team Hub page here.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 8. CONTACT & FAQ --}}
                    <div class="accordion-item card">
                        <h2 class="accordion-header" id="headingContact">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseContact">
                                <i class="bx bx-envelope me-2"></i> 8. Contact & FAQ
                            </button>
                        </h2>
                        <div id="collapseContact" class="accordion-collapse collapse" data-bs-parent="#settingsAccordion">
                            <div class="accordion-body  rounded p-4 border-top">

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div
                                            class="d-flex justify-content-between align-items-center bg-white p-3 rounded border">
                                            <p class="mb-0 fw-semibold text-dark"><i class="bx bx-show-alt me-1"></i>
                                                Contact Page Visibility</p>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input page-toggle fs-4" type="checkbox"
                                                    role="switch" name="show_contact_page" id="show_contact_page" {{ ($settings['show_contact_page'] ?? 1) ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="d-flex justify-content-between align-items-center bg-white p-3 rounded border">
                                            <p class="mb-0 fw-semibold text-dark"><i class="bx bx-show-alt me-1"></i> FAQ
                                                Page Visibility</p>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input page-toggle fs-4" type="checkbox"
                                                    role="switch" name="show_faq_page" id="show_faq_page" {{ ($settings['show_faq_page'] ?? 1) ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Contact Page Header</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Hero / Breadcrumb Image</label>
                                        <input class="form-control" type="file" name="contact_hero_image"
                                            id="hi-contact_hero_image" accept="image/*"
                                            onchange="imgPreview(this,'hp-contact_hero_image')">
                                        <div id="hp-contact_hero_image" class="mt-2" style="max-width:340px;">
                                            @if(!empty($settings['contact_hero_image']))
                                                <img src="{{ asset($settings['contact_hero_image']) }}"
                                                    class="img-fluid rounded border"
                                                    style="max-height:100px; width:100%; object-fit:cover;">
                                            @else
                                                <div class="text-muted small"><i class="bx bx-image"></i> Default:
                                                    <code>assets/img/bg/breadcumb-bg1-6.jpg</code></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Breadcrumb Title</label>
                                        <input type="text" class="form-control" name="contact_breadcrumb_title"
                                            value="{{ $settings['contact_breadcrumb_title'] ?? 'Contact Us' }}">

                                        <label class="form-label fw-semibold mt-3">Meta Description</label>
                                        <textarea class="form-control" name="contact_meta_description"
                                            rows="2">{{ $settings['contact_meta_description'] ?? '' }}</textarea>
                                    </div>
                                </div>

                                <hr>
                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">Contact Form Settings</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Contact Form Title</label>
                                        <input type="text" class="form-control" name="contact_form_title"
                                            value="{{ $settings['contact_form_title'] ?? 'Have Any Project on Your Mind?' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Contact Form Subtitle</label>
                                        <input type="text" class="form-control" name="contact_form_subtitle"
                                            value="{{ $settings['contact_form_subtitle'] ?? "Great! We're excited to hear from you." }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Fallback Phone</label>
                                        <input type="text" class="form-control" name="contact_fallback_phone"
                                            value="{{ $settings['contact_fallback_phone'] ?? '+1 (285) 335-5200' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Fallback Email</label>
                                        <input type="text" class="form-control" name="contact_fallback_email"
                                            value="{{ $settings['contact_fallback_email'] ?? 'wmventl@vmcore.com' }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Address Label</label>
                                        <input type="text" class="form-control" name="contact_label_address"
                                            value="{{ $settings['contact_label_address'] ?? 'Office Address' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Phone Label</label>
                                        <input type="text" class="form-control" name="contact_label_phone"
                                            value="{{ $settings['contact_label_phone'] ?? 'Phone' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Email Label</label>
                                        <input type="text" class="form-control" name="contact_label_email"
                                            value="{{ $settings['contact_label_email'] ?? 'Email' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Social Media Label</label>
                                        <input type="text" class="form-control" name="contact_label_social"
                                            value="{{ $settings['contact_label_social'] ?? 'Social Media' }}">
                                    </div>
                                </div>
                                <div class="row mb-3 mt-4">
                                    <div class="col-md-2">
                                        <label class="form-label">Name Field</label>
                                        <input type="text" class="form-control" name="contact_field_name"
                                            value="{{ $settings['contact_field_name'] ?? 'Name' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Email Field</label>
                                        <input type="text" class="form-control" name="contact_field_email"
                                            value="{{ $settings['contact_field_email'] ?? 'Email' }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Phone Field</label>
                                        <input type="text" class="form-control" name="contact_field_phone"
                                            value="{{ $settings['contact_field_phone'] ?? 'Phone No' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Subject Field</label>
                                        <input type="text" class="form-control" name="contact_field_subject"
                                            value="{{ $settings['contact_field_subject'] ?? 'Subject' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Submit Button</label>
                                        <input type="text" class="form-control" name="contact_submit_text"
                                            value="{{ $settings['contact_submit_text'] ?? 'Send Message' }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Contact Us Image</label>
                                    <input class="form-control" type="file" name="contact_image" id="hi-contact_image"
                                        accept="image/*" onchange="imgPreview(this,'hp-contact_image')">
                                    <div id="hp-contact_image" class="mt-2" style="max-width:200px;">
                                        @if(!empty($settings['contact_image']))
                                            <img src="{{ asset($settings['contact_image']) }}" class="img-fluid rounded border">
                                        @endif
                                    </div>
                                </div>

                                <hr>
                                <h6 class="fw-bold mt-3 mb-3 text-uppercase text-primary">FAQ Page Header & Content</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Hero / Breadcrumb Image</label>
                                        <input class="form-control" type="file" name="faq_hero_image" id="hi-faq_hero_image"
                                            accept="image/*" onchange="imgPreview(this,'hp-faq_hero_image')">
                                        <div id="hp-faq_hero_image" class="mt-2" style="max-width:340px;">
                                            @if(!empty($settings['faq_hero_image']))
                                                <img src="{{ asset($settings['faq_hero_image']) }}"
                                                    class="img-fluid rounded border"
                                                    style="max-height:100px; width:100%; object-fit:cover;">
                                            @else
                                                <div class="text-muted small"><i class="bx bx-image"></i> Default:
                                                    <code>assets/img/bg/breadcumb-bg1-7.jpg</code></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Breadcrumb Title</label>
                                        <input type="text" class="form-control" name="faq_breadcrumb_title"
                                            value="{{ $settings['faq_breadcrumb_title'] ?? 'FAQ' }}">

                                        <label class="form-label fw-semibold mt-3">Meta Description</label>
                                        <textarea class="form-control" name="faq_meta_description"
                                            rows="2">{{ $settings['faq_meta_description'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">FAQ Section Title</label>
                                        <input type="text" class="form-control" name="faq_title"
                                            value="{{ $settings['faq_title'] ?? 'Frequently Asked Questions' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Need Help Sidebar Title</label>
                                        <input type="text" class="form-control" name="sidebar_help_title"
                                            value="{{ $settings['sidebar_help_title'] ?? 'Need Help?' }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">FAQ Section Intro Text</label>
                                    <textarea class="form-control" name="faq_intro_text"
                                        rows="2">{{ $settings['faq_intro_text'] ?? '' }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Contact Page FAQ & Search Schema (JSON-LD)</label>
                                            <textarea class="form-control font-monospace" name="contact_faq_schema" rows="4" placeholder='<script type="application/ld+json">...</script>'>{{ $settings['contact_faq_schema'] ?? '' }}</textarea>
                                            <div class="form-text small">Paste JSON-LD script for the Contact page here.</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">FAQ Page FAQ & Search Schema (JSON-LD)</label>
                                            <textarea class="form-control font-monospace" name="faq_page_faq_schema" rows="4" placeholder='<script type="application/ld+json">...</script>'>{{ $settings['faq_page_faq_schema'] ?? '' }}</textarea>
                                            <div class="form-text small">Paste JSON-LD script for the FAQ page here.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.content._partials.form-actions', [
                'label' => 'Save Frontend Content'
            ])
        </div>
    </form>

    <script>
        function imgPreview(input, previewId) {
            var box = document.getElementById(previewId);
            if (!box) return;
            box.innerHTML = ''; // reset
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-fluid rounded border mt-2';
                    img.style.maxHeight = '100px';
                    img.style.width = '100%';
                    img.style.objectFit = 'cover';
                    box.appendChild(img);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection