@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Theme Settings')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Theme</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Theme Settings</h5>
                    <hr class="my-0">
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form id="formAccountSettings" method="POST" action="{{ route('admin.settings.theme.update') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="theme_primary_color" class="form-label">Primary Color</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="theme_primary_color"
                                            name="theme_primary_color" value="{{ $primaryColor }}"
                                            title="Choose your color">
                                        <input type="text" class="form-control" value="{{ $primaryColor }}" readonly>
                                    </div>
                                    <div class="form-text">Select the primary color for the admin panel and frontend
                                        website.</div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="theme_secondary_color" class="form-label">Secondary Color</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="theme_secondary_color"
                                            name="theme_secondary_color" value="{{ $secondaryColor }}"
                                            title="Choose your secondary color">
                                        <input type="text" class="form-control" value="{{ $secondaryColor }}" readonly>
                                    </div>
                                    <div class="form-text">Select the secondary color for accents and highlights.</div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="theme_font_color" class="form-label">Font Color</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="theme_font_color"
                                            name="theme_font_color" value="{{ $fontColor }}" title="Choose your font color">
                                        <input type="text" class="form-control" value="{{ $fontColor }}" readonly>
                                    </div>
                                    <div class="form-text">Select the default font color.</div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="theme_bg_color" class="form-label">Background Color</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="theme_bg_color"
                                            name="theme_bg_color" value="{{ $bgColor }}"
                                            title="Choose your background color">
                                        <input type="text" class="form-control" value="{{ $bgColor }}" readonly>
                                    </div>
                                    <div class="form-text">Select the default background color.</div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="theme_card_color" class="form-label">Card Background Color</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="theme_card_color"
                                            name="theme_card_color" value="{{ $cardColor }}"
                                            title="Choose your card background color">
                                        <input type="text" class="form-control" value="{{ $cardColor }}" readonly>
                                    </div>
                                    <div class="form-text">Select the default background color for cards.</div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="theme_border_color" class="form-label">Border Color</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="theme_border_color"
                                            name="theme_border_color" value="{{ $borderColor }}"
                                            title="Choose your border color">
                                        <input type="text" class="form-control" value="{{ $borderColor }}" readonly>
                                    </div>
                                    <div class="form-text">Select the default color for borders.</div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="theme_footer_color" class="form-label">Footer Background Color</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="theme_footer_color"
                                            name="theme_footer_color" value="{{ $footerColor }}"
                                            title="Choose your footer background color">
                                        <input type="text" class="form-control" value="{{ $footerColor }}" readonly>
                                    </div>
                                    <div class="form-text">Select the default background color for the footer.</div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="theme_icon_bg_color" class="form-label">Icon Background Color</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="theme_icon_bg_color"
                                            name="theme_icon_bg_color" value="{{ $iconBgColor }}"
                                            title="Choose your icon background color">
                                        <input type="text" class="form-control" value="{{ $iconBgColor }}" readonly>
                                    </div>
                                    <div class="form-text">Select the default background color for the inner card icons.</div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        ['theme_primary_color', 'theme_secondary_color', 'theme_font_color', 'theme_bg_color', 'theme_card_color', 'theme_border_color', 'theme_footer_color', 'theme_icon_bg_color'].forEach(id => {
            document.getElementById(id).addEventListener('input', function () {
                this.nextElementSibling.value = this.value;
            });
        });
    </script>
@endsection