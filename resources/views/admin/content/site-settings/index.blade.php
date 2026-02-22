@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Site Settings')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Site Settings</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#general">General</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#seo">SEO</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#branding">Branding</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="general">
                            <div class="row">
                                <div class="col-md-6 mb-3"><label class="form-label">Site Name</label><input type="text"
                                        class="form-control" name="site_name" value="{{ $settings['site_name'] ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3"><label class="form-label">Site Email</label><input type="email"
                                        class="form-control" name="site_email" value="{{ $settings['site_email'] ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3"><label class="form-label">Phone</label><input type="text"
                                        class="form-control" name="site_phone" value="{{ $settings['site_phone'] ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3"><label class="form-label">Address</label><input type="text"
                                        class="form-control" name="site_address"
                                        value="{{ $settings['site_address'] ?? '' }}"></div>
                            </div>
                            <div class="mb-3"><label class="form-label">Footer Text</label><textarea class="form-control"
                                    name="footer_text" rows="2">{{ $settings['footer_text'] ?? '' }}</textarea></div>
                            <div class="mb-3"><label class="form-label">Copyright Text</label><input type="text"
                                    class="form-control" name="copyright_text"
                                    value="{{ $settings['copyright_text'] ?? '' }}"></div>
                        </div>

                        <div class="tab-pane fade" id="seo">
                            <div class="mb-3"><label class="form-label">Meta Title</label><input type="text"
                                    class="form-control" name="meta_title" value="{{ $settings['meta_title'] ?? '' }}">
                            </div>
                            <div class="mb-3"><label class="form-label">Meta Description</label><textarea
                                    class="form-control" name="meta_description"
                                    rows="3">{{ $settings['meta_description'] ?? '' }}</textarea></div>
                            <div class="mb-3"><label class="form-label">Meta Keywords</label><input type="text"
                                    class="form-control" name="meta_keywords"
                                    value="{{ $settings['meta_keywords'] ?? '' }}"></div>
                            <div class="mb-3"><label class="form-label">Google Analytics ID</label><input type="text"
                                    class="form-control" name="google_analytics_id"
                                    value="{{ $settings['google_analytics_id'] ?? '' }}" placeholder="G-XXXXXXXXXX"></div>
                        </div>

                        <div class="tab-pane fade" id="branding">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Site Logo</label>
                                        @include('admin.content._partials.image-preview', ['field' => 'site_logo', 'existing' => $settings['site_logo'] ?? null])
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Favicon</label>
                                        @include('admin.content._partials.image-preview', ['field' => 'favicon', 'existing' => $settings['favicon'] ?? null])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-primary"><i class="bx bx-save me-1"></i> Save Settings</button>
                </form>
            </div>
        </div>
    </div>
@endsection