@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Frontend Content Settings')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Frontend Content</h4>

    <form action="{{ route('admin.settings.frontend.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Home Page Content -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">Home Page Sections</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Services Section Title</label>
                            <input type="text" class="form-control" name="home_services_title"
                                value="{{ $settings['home_services_title'] ?? 'What We Can Do for Our Clients' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Skills Section Title</label>
                            <input type="text" class="form-control" name="home_skills_title"
                                value="{{ $settings['home_skills_title'] ?? 'We Offer a Wide Range of Brand Services' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Skills Section Subtitle</label>
                            <textarea class="form-control" name="home_skills_subtitle"
                                rows="2">{{ $settings['home_skills_subtitle'] ?? 'We are a creative agency working with brands building insightful strategy, creating unique designs and crafting value' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Portfolio Section Title</label>
                            <input type="text" class="form-control" name="home_portfolio_title"
                                value="{{ $settings['home_portfolio_title'] ?? 'Discover Our Selected Projects' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Blog Section Title</label>
                            <input type="text" class="form-control" name="home_blog_title"
                                value="{{ $settings['home_blog_title'] ?? 'Read Our Articles and News' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CTA Section Title</label>
                            <input type="text" class="form-control" name="home_cta_title"
                                value="{{ $settings['home_cta_title'] ?? 'Let's Create Something Great' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CTA Section Subtitle</label>
                            <textarea class="form-control" name="home_cta_subtitle"
                                rows="2">{{ $settings['home_cta_subtitle'] ?? 'We shift you from today's reality to tomorrow's potential, ensuring' }}</textarea>
                        </div>
                        <hr>
                        <p class="fw-semibold mb-2 text-muted small text-uppercase">Section Background Images</p>
                        <div class="mb-3">
                            <label class="form-label">Skills Section — Side Image</label>
                            <input class="form-control" type="file" name="home_skills_bg" id="hi-home_skills_bg"
                                accept="image/*" onchange="heroPreview(this,'hp-home_skills_bg')">
                            <small class="text-muted">Shown on the left of the skills/service section.</small>
                            <div id="hp-home_skills_bg" class="mt-2 position-relative"
                                style="display:none;max-width:300px;">
                                <img src="" class="img-fluid rounded w-100" style="max-height:90px;object-fit:cover;"
                                    alt="">
                                <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-1"
                                    style="font-size:.7rem;">New — not saved</span>
                            </div>
                            @if(!empty($settings['home_skills_bg']))
                                <div class="mt-2 position-relative" style="max-width:300px;">
                                    <img src="{{ asset($settings['home_skills_bg']) }}" class="img-fluid rounded w-100"
                                        style="max-height:90px;object-fit:cover;" alt="">
                                    <span class="badge bg-success position-absolute top-0 end-0 m-1">Active</span>
                                </div>
                            @else
                                <div class="mt-1 text-muted small"><i class="bx bx-image"></i> Default:
                                    <code>assets/img/normal/service_2-1.jpg</code></div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Video Section — Background Image</label>
                            <input class="form-control" type="file" name="home_video_bg" id="hi-home_video_bg"
                                accept="image/*" onchange="heroPreview(this,'hp-home_video_bg')">
                            <small class="text-muted">Full-width background behind the play button.</small>
                            <div id="hp-home_video_bg" class="mt-2 position-relative" style="display:none;max-width:300px;">
                                <img src="" class="img-fluid rounded w-100" style="max-height:90px;object-fit:cover;"
                                    alt="">
                                <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-1"
                                    style="font-size:.7rem;">New — not saved</span>
                            </div>
                            @if(!empty($settings['home_video_bg']))
                                <div class="mt-2 position-relative" style="max-width:300px;">
                                    <img src="{{ asset($settings['home_video_bg']) }}" class="img-fluid rounded w-100"
                                        style="max-height:90px;object-fit:cover;" alt="">
                                    <span class="badge bg-success position-absolute top-0 end-0 m-1">Active</span>
                                </div>
                            @else
                                <div class="mt-1 text-muted small"><i class="bx bx-image"></i> Default:
                                    <code>assets/img/normal/video_2-1.jpg</code></div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <h5 class="card-header">Portfolio Details</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Project Gallery Title</label>
                            <input type="text" class="form-control" name="portfolio_gallery_title"
                                value="{{ $settings['portfolio_gallery_title'] ?? 'Project Gallery' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Project Info Title</label>
                            <input type="text" class="form-control" name="portfolio_info_title"
                                value="{{ $settings['portfolio_info_title'] ?? 'Project Info' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tags Title</label>
                            <input type="text" class="form-control" name="portfolio_tags_title"
                                value="{{ $settings['portfolio_tags_title'] ?? 'Tags' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Client Testimonials Title</label>
                            <input type="text" class="form-control" name="portfolio_testimonials_title"
                                value="{{ $settings['portfolio_testimonials_title'] ?? 'Client Testimonials' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Related Projects Title</label>
                            <input type="text" class="form-control" name="portfolio_related_title"
                                value="{{ $settings['portfolio_related_title'] ?? 'Related Projects' }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- About Page Content -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">About Page Sections</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Our Expertise Title</label>
                            <input type="text" class="form-control" name="about_skills_title"
                                value="{{ $settings['about_skills_title'] ?? 'Our Expertise' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Team Section Title</label>
                            <input type="text" class="form-control" name="about_team_title"
                                value="{{ $settings['about_team_title'] ?? 'Meet Our Creative Team' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Awards Section Title</label>
                            <input type="text" class="form-control" name="about_awards_title"
                                value="{{ $settings['about_awards_title'] ?? 'Awards & Recognition' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Testimonials Section Title</label>
                            <input type="text" class="form-control" name="about_testimonials_title"
                                value="{{ $settings['about_testimonials_title'] ?? 'What Our Clients Say' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Clients Section Title</label>
                            <input type="text" class="form-control" name="about_clients_title"
                                value="{{ $settings['about_clients_title'] ?? 'Our Clients' }}">
                        </div>
                        <hr>
                        <p class="fw-semibold mb-2 text-muted small text-uppercase">Section Images</p>
                        <div class="mb-3">
                            <label class="form-label">About Section — Side Image</label>
                            <input class="form-control" type="file" name="about_side_image" id="hi-about_side_image"
                                accept="image/*" onchange="heroPreview(this,'hp-about_side_image')">
                            <small class="text-muted">Left-column photo in the About intro section.</small>
                            <div id="hp-about_side_image" class="mt-2 position-relative"
                                style="display:none;max-width:300px;">
                                <img src="" class="img-fluid rounded w-100" style="max-height:90px;object-fit:cover;"
                                    alt="">
                                <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-1"
                                    style="font-size:.7rem;">New — not saved</span>
                            </div>
                            @if(!empty($settings['about_side_image']))
                                <div class="mt-2 position-relative" style="max-width:300px;">
                                    <img src="{{ asset($settings['about_side_image']) }}" class="img-fluid rounded w-100"
                                        style="max-height:90px;object-fit:cover;" alt="">
                                    <span class="badge bg-success position-absolute top-0 end-0 m-1">Active</span>
                                </div>
                            @else
                                <div class="mt-1 text-muted small"><i class="bx bx-image"></i> Default:
                                    <code>assets/img/normal/about_2-1.jpg</code></div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Global Widgets & Sidebars -->
                <div class="card mb-4">
                    <h5 class="card-header">Sidebar & Other Widgets</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">All Services Sidebar Title</label>
                            <input type="text" class="form-control" name="sidebar_services_title"
                                value="{{ $settings['sidebar_services_title'] ?? 'All Services' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Need Help Sidebar Title</label>
                            <input type="text" class="form-control" name="sidebar_help_title"
                                value="{{ $settings['sidebar_help_title'] ?? 'Need Help?' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Blog Categories Title</label>
                            <input type="text" class="form-control" name="sidebar_categories_title"
                                value="{{ $settings['sidebar_categories_title'] ?? 'Categories' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Recent Posts Title</label>
                            <input type="text" class="form-control" name="sidebar_recent_posts_title"
                                value="{{ $settings['sidebar_recent_posts_title'] ?? 'Recent Posts' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Blog Tags Title</label>
                            <input type="text" class="form-control" name="sidebar_tags_title"
                                value="{{ $settings['sidebar_tags_title'] ?? 'Tags' }}">
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">Service Related Projects Title</label>
                            <input type="text" class="form-control" name="service_related_projects_title"
                                value="{{ $settings['service_related_projects_title'] ?? 'Related Projects' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Form Title</label>
                            <input type="text" class="form-control" name="contact_form_title"
                                value="{{ $settings['contact_form_title'] ?? 'Have Any Project on Your Mind?' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Form Subtitle</label>
                            <textarea class="form-control" name="contact_form_subtitle"
                                rows="2">{{ $settings['contact_form_subtitle'] ?? "Great! We're excited to hear from you and let's start something" }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">FAQ Section Title</label>
                            <input type="text" class="form-control" name="faq_title"
                                value="{{ $settings['faq_title'] ?? 'Frequently Asked Questions' }}">
                        </div>
                        <hr>
                        <p class="fw-semibold mb-2 text-muted small text-uppercase">Detail Page Breadcrumb Images</p>
                        <div class="mb-3">
                            <label class="form-label">Service Detail — Breadcrumb Background</label>
                            <input class="form-control" type="file" name="service_detail_hero_image"
                                id="hi-service_detail_hero_image" accept="image/*"
                                onchange="heroPreview(this,'hp-service_detail_hero_image')">
                            <small class="text-muted">Hero bg shown on each individual service page.</small>
                            <div id="hp-service_detail_hero_image" class="mt-2 position-relative"
                                style="display:none;max-width:300px;">
                                <img src="" class="img-fluid rounded w-100" style="max-height:90px;object-fit:cover;"
                                    alt="">
                                <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-1"
                                    style="font-size:.7rem;">New — not saved</span>
                            </div>
                            @if(!empty($settings['service_detail_hero_image']))
                                <div class="mt-2 position-relative" style="max-width:300px;">
                                    <img src="{{ asset($settings['service_detail_hero_image']) }}"
                                        class="img-fluid rounded w-100" style="max-height:90px;object-fit:cover;" alt="">
                                    <span class="badge bg-success position-absolute top-0 end-0 m-1">Active</span>
                                </div>
                            @else
                                <div class="mt-1 text-muted small"><i class="bx bx-image"></i> Default:
                                    <code>assets/img/bg/breadcumb-bg1-2.jpg</code></div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Portfolio Detail — Breadcrumb Background</label>
                            <input class="form-control" type="file" name="portfolio_detail_hero_image"
                                id="hi-portfolio_detail_hero_image" accept="image/*"
                                onchange="heroPreview(this,'hp-portfolio_detail_hero_image')">
                            <small class="text-muted">Hero bg shown on each individual project page.</small>
                            <div id="hp-portfolio_detail_hero_image" class="mt-2 position-relative"
                                style="display:none;max-width:300px;">
                                <img src="" class="img-fluid rounded w-100" style="max-height:90px;object-fit:cover;"
                                    alt="">
                                <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-1"
                                    style="font-size:.7rem;">New — not saved</span>
                            </div>
                            @if(!empty($settings['portfolio_detail_hero_image']))
                                <div class="mt-2 position-relative" style="max-width:300px;">
                                    <img src="{{ asset($settings['portfolio_detail_hero_image']) }}"
                                        class="img-fluid rounded w-100" style="max-height:90px;object-fit:cover;" alt="">
                                    <span class="badge bg-success position-absolute top-0 end-0 m-1">Active</span>
                                </div>
                            @else
                                <div class="mt-1 text-muted small"><i class="bx bx-image"></i> Default:
                                    <code>assets/img/bg/breadcumb-bg1-5.jpg</code></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Page Headers & Hero Images ──────────────────── --}}
            <div class="col-12">
                <div class="card mb-4">
                    <h5 class="card-header d-flex align-items-center gap-2">
                        <i class="bx bx-image-alt"></i> Page Headers &amp; Hero Images
                        <small class="text-muted fw-normal fs-6 ms-1">— breadcrumb background, title &amp; meta for each
                            page</small>
                    </h5>
                    <div class="card-body p-0">
                        <div class="accordion" id="pageHeadersAccordion">
                            @php
                                $pageHeaders = [
                                    'about' => ['label' => 'About', 'default_img' => 'assets/img/bg/breadcumb-bg1-3.jpg', 'default_title' => 'About Us', 'has_intro' => true],
                                    'services' => ['label' => 'Services', 'default_img' => 'assets/img/bg/breadcumb-bg1-2.jpg', 'default_title' => 'Services', 'has_intro' => true],
                                    'team' => ['label' => 'Team', 'default_img' => 'assets/img/bg/breadcumb-bg1-4.jpg', 'default_title' => 'Our Team', 'has_intro' => true],
                                    'faq' => ['label' => 'FAQ', 'default_img' => 'assets/img/bg/breadcumb-bg1-7.jpg', 'default_title' => 'FAQ', 'has_intro' => false],
                                    'portfolio' => ['label' => 'Portfolio', 'default_img' => 'assets/img/bg/breadcumb-bg1-5.jpg', 'default_title' => 'Portfolio', 'has_intro' => false],
                                    'blog' => ['label' => 'Blog', 'default_img' => 'assets/img/bg/breadcumb-bg1-8.jpg', 'default_title' => 'Blog', 'has_intro' => false],
                                    'contact' => ['label' => 'Contact', 'default_img' => 'assets/img/bg/breadcumb-bg1-6.jpg', 'default_title' => 'Contact Us', 'has_intro' => false],
                                ];
                            @endphp

                            @foreach($pageHeaders as $slug => $page)
                                @php
                                    $heroKey = $slug . '_hero_image';
                                    $titleKey = $slug . '_breadcrumb_title';
                                    $metaKey = $slug . '_meta_description';
                                    $introTitle = $slug . '_intro_title';
                                    $introDesc = $slug . '_intro_description';
                                    $introText = $slug . '_page_intro';
                                    $currentImg = $settings[$heroKey] ?? null;
                                @endphp
                                <div class="accordion-item border-0 border-bottom">
                                    <h2 class="accordion-header" id="heading-{{ $slug }}">
                                        <button class="accordion-button collapsed fw-semibold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse-{{ $slug }}">
                                            <i class="bx bx-file me-2 text-primary"></i>
                                            {{ $page['label'] }} Page
                                            @if($currentImg)
                                                <span class="badge bg-label-success ms-2 fw-normal">Custom image set</span>
                                            @endif
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $slug }}" class="accordion-collapse collapse"
                                        data-bs-parent="#pageHeadersAccordion">
                                        <div class="accordion-body">
                                            <div class="row g-3">
                                                {{-- Hero Image --}}
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold">Hero / Breadcrumb Background
                                                        Image</label>
                                                    <input class="form-control" type="file" name="{{ $heroKey }}"
                                                        id="hi-{{ $heroKey }}" accept="image/*"
                                                        onchange="heroPreview(this,'hp-{{ $heroKey }}')">
                                                    <small class="text-muted">Recommended: 1920×600px. Leave empty to keep
                                                        current.</small>

                                                    {{-- Live preview shown on file selection --}}
                                                    <div id="hp-{{ $heroKey }}" class="mt-2 position-relative"
                                                        style="display:none;max-width:340px;">
                                                        <img src="" class="img-fluid rounded w-100"
                                                            style="max-height:110px;object-fit:cover;" alt="">
                                                        <span
                                                            class="badge bg-warning text-dark position-absolute top-0 end-0 m-1"
                                                            style="font-size:.7rem;">New — not saved</span>
                                                    </div>

                                                    @if($currentImg)
                                                        <div class="mt-2 position-relative" style="max-width:340px;">
                                                            <img src="{{ asset($currentImg) }}" class="img-fluid rounded"
                                                                style="max-height:100px; width:100%; object-fit:cover;"
                                                                alt="Current hero">
                                                            <span
                                                                class="badge bg-success position-absolute top-0 end-0 m-1">Active</span>
                                                        </div>
                                                    @else
                                                        <div class="mt-2 text-muted small">
                                                            <i class="bx bx-image"></i> Default:
                                                            <code>{{ $page['default_img'] }}</code>
                                                        </div>
                                                    @endif
                                                </div>


                                                {{-- Breadcrumb Title --}}
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold">Breadcrumb / Page Title</label>
                                                    <input type="text" class="form-control" name="{{ $titleKey }}"
                                                        value="{{ $settings[$titleKey] ?? $page['default_title'] }}"
                                                        placeholder="{{ $page['default_title'] }}">
                                                    <small class="text-muted">The <code>&lt;h1&gt;</code> displayed over the
                                                        hero image.</small>

                                                    <label class="form-label fw-semibold mt-3">Meta Description</label>
                                                    <textarea class="form-control" name="{{ $metaKey }}" rows="2"
                                                        placeholder="Short description for search engines...">{{ $settings[$metaKey] ?? '' }}</textarea>
                                                </div>

                                                {{-- About-specific intro --}}
                                                @if($slug === 'about')
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Intro Section — Main Title</label>
                                                        <input type="text" class="form-control" name="{{ $introTitle }}"
                                                            value="{{ $settings[$introTitle] ?? 'We Are Creative Digital Agency' }}"
                                                            placeholder="We Are Creative Digital Agency">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Intro Section — Description</label>
                                                        <textarea class="form-control" name="{{ $introDesc }}" rows="3"
                                                            placeholder="Short intro paragraph...">{{ $settings[$introDesc] ?? '' }}</textarea>
                                                    </div>
                                                @endif

                                                {{-- Services / Team page intro --}}
                                                @if(in_array($slug, ['services', 'team']))
                                                    <div class="col-12">
                                                        <label class="form-label fw-semibold">Page Intro Text <small
                                                                class="text-muted">(shown below breadcrumb)</small></label>
                                                        <textarea class="form-control" name="{{ $introText }}" rows="2"
                                                            placeholder="Optional introductory paragraph...">{{ $settings[$introText] ?? '' }}</textarea>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Page Visibility Toggles ──────────────────────── --}}

            <div class="col-12">
                <div class="card mb-4">
                    <h5 class="card-header d-flex align-items-center gap-2">
                        <i class="bx bx-show-alt"></i> Page Visibility
                        <small class="text-muted fw-normal fs-6 ms-1">— toggle pages on/off for frontend visitors</small>
                    </h5>
                    <div class="card-body">
                        <div class="row g-3">
                            @php
                                $pages = [
                                    'show_about_page' => ['label' => 'About', 'icon' => 'bx-user', 'url' => '/about'],
                                    'show_services_page' => ['label' => 'Services', 'icon' => 'bx-briefcase', 'url' => '/services'],
                                    'show_team_page' => ['label' => 'Team', 'icon' => 'bx-group', 'url' => '/team'],
                                    'show_faq_page' => ['label' => 'FAQ', 'icon' => 'bx-help-circle', 'url' => '/faq'],
                                    'show_portfolio_page' => ['label' => 'Portfolio', 'icon' => 'bx-layout', 'url' => '/portfolio'],
                                    'show_blog_page' => ['label' => 'Blog', 'icon' => 'bx-news', 'url' => '/blog'],
                                    'show_contact_page' => ['label' => 'Contact', 'icon' => 'bx-envelope', 'url' => '/contact'],
                                ];
                            @endphp

                            @foreach($pages as $key => $page)
                                <div class="col-md-3 col-sm-4 col-6">
                                    <div
                                        class="border rounded p-3 d-flex align-items-center justify-content-between h-100
                                                                                                        {{ ($settings[$key] ?? 1) ? 'bg-label-success' : 'bg-label-secondary' }}">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bx {{ $page['icon'] }} fs-5"></i>
                                            <div>
                                                <div class="fw-semibold">{{ $page['label'] }}</div>
                                                <small class="text-muted">{{ $page['url'] }}</small>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch ms-3 mb-0">
                                            <input class="form-check-input page-toggle" type="checkbox" role="switch"
                                                name="{{ $key }}" id="{{ $key }}" {{ ($settings[$key] ?? 1) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <p class="text-muted small mt-3 mb-0">
                            <i class="bx bx-info-circle"></i>
                            Hiding a page returns <strong>404</strong> to visitors and hides its link from the default
                            navigation fallback.
                            If you manage navigation via <a href="{{ route('admin.menus.index') }}">Admin → Menus</a>,
                            remove the link there too.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-primary d-block w-100 p-3 fs-5">Save Frontend Content</button>
            </div>
        </div>
    </form>

    <script>
        function heroPreview(input, previewId) {
            var box = document.getElementById(previewId);
            var img = box ? box.querySelector('img') : null;
            if (input.files && input.files[0] && img) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    img.src = e.target.result;
                    box.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            } else if (box) {
                box.style.display = 'none';
            }
        }
    </script>
@endsection
