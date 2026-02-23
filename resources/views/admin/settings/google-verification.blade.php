@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Google Verification Settings')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Settings /</span> Google Verification
    </h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card mb-4">
                <h5 class="card-header">Google reCAPTCHA v3 Configuration</h5>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.settings.google-verification.update') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="google_verification_enabled">Enable Google Verification</label>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="google_verification_enabled"
                                    name="google_verification_enabled" value="1" {{ google_setting('google_verification_enabled') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="google_verification_enabled">Turn On/Off</label>
                            </div>
                            @error('google_verification_enabled')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="google_recaptcha_site_key">Site Key</label>
                            <input type="text" class="form-control" id="google_recaptcha_site_key"
                                name="google_recaptcha_site_key"
                                value="{{ old('google_recaptcha_site_key', google_setting('google_recaptcha_site_key')) }}"
                                placeholder="Enter Site Key">
                            @error('google_recaptcha_site_key')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="google_recaptcha_secret_key">Secret Key</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="google_recaptcha_secret_key" class="form-control"
                                    name="google_recaptcha_secret_key"
                                    value="{{ old('google_recaptcha_secret_key', google_setting('google_recaptcha_secret_key')) }}"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="google_recaptcha_secret_key" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            <small class="text-muted">Will not be exposed to the frontend.</small>
                            @error('google_recaptcha_secret_key')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary d-flex align-items-center">
                                <i class="bx bx-save me-1"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection