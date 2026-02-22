@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Global Settings')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Global Settings</h4>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Basic Info -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">Basic Information</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Site Name</label>
                            <input type="text" class="form-control" name="site_name"
                                value="{{ $settings['site_name'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Email</label>
                            <input type="email" class="form-control" name="contact_email"
                                value="{{ $settings['contact_email'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $settings['phone'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" name="address"
                                rows="3">{{ $settings['address'] ?? '' }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Footer Text</label>
                            <input type="text" class="form-control" name="footer_text"
                                value="{{ $settings['footer_text'] ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Defaults & Branding -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">Default SEO & Branding</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Default Meta Title</label>
                            <input type="text" class="form-control" name="default_meta_title"
                                value="{{ $settings['default_meta_title'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Default Meta Description</label>
                            <textarea class="form-control" name="default_meta_description"
                                rows="3">{{ $settings['default_meta_description'] ?? '' }}</textarea>
                        </div>

                        <hr class="my-4">

                        <div class="mb-3">
                            <label class="form-label">Logo</label>
                            <input class="form-control mb-2" type="file" name="logo">
                            @if(!empty($settings['logo']))
                                <img src="{{ asset($settings['logo']) }}" alt="Logo" class="bg-dark p-2 rounded" width="100">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Logo (White / Transparent)</label>
                            <small class="d-block text-muted mb-2">Used for dark backgrounds (Home hero & Sidebar)</small>
                            <input class="form-control mb-2" type="file" name="logo_white">
                            @if(!empty($settings['logo_white']))
                                <img src="{{ asset($settings['logo_white']) }}" alt="Logo White" class="bg-dark p-2 rounded"
                                    width="100">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Footer Logo</label>
                            <input class="form-control mb-2" type="file" name="footer_logo">
                            @if(!empty($settings['footer_logo']))
                                <img src="{{ asset($settings['footer_logo']) }}" alt="Footer Logo" class="bg-dark p-2 rounded"
                                    width="100">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Favicon</label>
                            <input class="form-control mb-2" type="file" name="favicon">
                            @if(!empty($settings['favicon']))
                                <img src="{{ asset($settings['favicon']) }}" alt="Favicon" width="32">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-primary d-block w-100 p-3 fs-5">Save Settings</button>
            </div>
        </div>
    </form>
@endsection