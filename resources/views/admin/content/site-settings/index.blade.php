@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Site Settings')
@section('content')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1">Site Settings</h4>
            <p class="text-muted mb-0">Manage your website settings, branding, and SEO</p>
        </div>
    </div>


    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form method="GET" class="row g-3 mb-3">
                    <div class="col-auto">
                        <select name="per_page" class="form-select" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 Per Page</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 Per Page</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 Per Page</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 Per Page</option>
                        </select>
                    </div>
                </form>
                <ul class="nav nav-tabs mb-4" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#general"><i
                                class="bx bx-cog me-1"></i>General</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#contact"><i
                                class="bx bx-phone me-1"></i>Contact</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#seo"><i
                                class="bx bx-search-alt me-1"></i>SEO</a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#branding"><i
                                class="bx bx-palette me-1"></i>Branding</a></li>
                </ul>

                <div class="tab-content">
                    {{-- General Tab --}}
                    <div class="tab-pane fade show active" id="general">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Site Name</label>
                                <input type="text" class="form-control" name="site_name"
                                    value="{{ $settings['site_name'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Site Tagline</label>
                                <input type="text" class="form-control" name="site_tagline"
                                    value="{{ $settings['site_tagline'] ?? '' }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Site Description</label>
                                <textarea class="form-control" name="site_description"
                                    rows="2">{{ $settings['site_description'] ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Footer Text</label>
                                <textarea class="form-control" name="footer_text"
                                    rows="2">{{ $settings['footer_text'] ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Copyright Text</label>
                                <input type="text" class="form-control" name="copyright_text"
                                    value="{{ $settings['copyright_text'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    {{-- Contact Tab --}}
                    <div class="tab-pane fade" id="contact">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" class="form-control" name="site_email"
                                    value="{{ $settings['site_email'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <input type="text" class="form-control" name="site_phone"
                                    value="{{ $settings['site_phone'] ?? '' }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Address</label>
                                <input type="text" class="form-control" name="site_address"
                                    value="{{ $settings['site_address'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    {{-- SEO Tab --}}
                    <div class="tab-pane fade" id="seo">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title"
                                    value="{{ $settings['meta_title'] ?? '' }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Meta Description</label>
                                <textarea class="form-control" name="meta_description"
                                    rows="3">{{ $settings['meta_description'] ?? '' }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Meta Keywords</label>
                                <input type="text" class="form-control" name="meta_keywords"
                                    value="{{ $settings['meta_keywords'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Google Analytics ID</label>
                                <input type="text" class="form-control" name="google_analytics_id"
                                    value="{{ $settings['google_analytics_id'] ?? '' }}" placeholder="G-XXXXXXXXXX">
                            </div>
                        </div>
                    </div>

                    {{-- Branding Tab --}}
                    <div class="tab-pane fade" id="branding">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Site Logo (Dark)</label>
                                <input type="file" class="form-control" name="site_logo" accept="image/*">
                                @if(!empty($settings['site_logo']))
                                    <div class="mt-2 p-2 border rounded bg-light">
                                        <img src="{{ asset($settings['site_logo']) }}" alt="Logo" style="max-height: 60px;">
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Site Logo (White)</label>
                                <input type="file" class="form-control" name="site_logo_white" accept="image/*">
                                @if(!empty($settings['site_logo_white']))
                                    <div class="mt-2 p-2 border rounded bg-dark">
                                        <img src="{{ asset($settings['site_logo_white']) }}" alt="Logo White"
                                            style="max-height: 60px;">
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Favicon</label>
                                <input type="file" class="form-control" name="site_favicon" accept="image/*">
                                @if(!empty($settings['site_favicon']))
                                    <div class="mt-2 p-2 border rounded bg-light">
                                        <img src="{{ asset($settings['site_favicon']) }}" alt="Favicon"
                                            style="max-height: 40px;">
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Contact Page Image</label>
                                <input type="file" class="form-control" name="contact_image" accept="image/*">
                                <small class="text-muted">Displayed on the Contact Us page instead of a map</small>
                                @if(!empty($settings['contact_image']))
                                    <div class="mt-2 p-2 border rounded bg-light">
                                        <img src="{{ asset($settings['contact_image']) }}" alt="Contact"
                                            style="max-height: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">
                <button type="submit" class="btn btn-primary"><i class="bx bx-save me-1"></i> Save Settings</button>
            </div>
        </div>
    </form>
@endsection