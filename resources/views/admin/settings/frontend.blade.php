@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Frontend Content Settings')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Frontend Content</h4>

    <form action="{{ route('admin.settings.frontend.update') }}" method="POST">
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
                                value="{{ $settings['home_cta_title'] ?? 'Let\'s Create Something Great' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CTA Section Subtitle</label>
                            <textarea class="form-control" name="home_cta_subtitle"
                                rows="2">{{ $settings['home_cta_subtitle'] ?? 'We shift you from today\'s reality to tomorrow\'s potential, ensuring' }}</textarea>
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
                            <label class="form-label">FAQ Section Title</label>
                            <input type="text" class="form-control" name="faq_title"
                                value="{{ $settings['faq_title'] ?? 'Frequently Asked Questions' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-primary d-block w-100 p-3 fs-5">Save Frontend Content</button>
            </div>
        </div>
    </form>
@endsection