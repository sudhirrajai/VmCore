@extends('admin.layouts.contentNavbarLayout')

@section('title', 'SEO Settings')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Settings /</span> SEO & Sitemap</h4>
<form action="{{ route('admin.settings.seo.update') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Sitemap Settings -->
            <div class="col-md-5">
                <div class="card mb-4">
                    <h5 class="card-header">Sitemap Configuration</h5>
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="sitemap_enabled" id="sitemap_enabled" value="1" {{ ($settings['sitemap_enabled'] ?? '1') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="sitemap_enabled">Enable Dynamic Sitemap</label>
                            </div>
                            <p class="text-muted small">When enabled, your sitemap will be automatically generated at <code>/sitemap.xml</code>.</p>
                        </div>

                        <div class="divider">
                            <div class="divider-text">Quick Links</div>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ url('sitemap.xml') }}" target="_blank" class="btn btn-outline-primary">
                                <i class="bx bx-link-external me-1"></i> View Live Sitemap
                            </a>
                            <a href="{{ url('robots.txt') }}" target="_blank" class="btn btn-outline-secondary">
                                <i class="bx bx-bot me-1"></i> View Live Robots.txt
                            </a>
                        </div>

                        <div class="mt-4 p-3 bg-label-info rounded">
                            <h6 class="mb-2"><i class="bx bx-info-circle me-1"></i> SEO Tip</h6>
                            <p class="mb-0 small">Submit your sitemap URL to <strong>Google Search Console</strong> to help search engines index your content faster.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Robots.txt Settings -->
            <div class="col-md-7">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Robots.txt Editor</h5>
                        <span class="badge bg-label-primary">Dynamic</span>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">
                            The <code>robots.txt</code> file tells search engine crawlers which pages or files the crawler can or can't request from your site.
                        </p>
                        <div class="mb-3">
                            <textarea class="form-control font-monospace" name="robots_txt" id="robots_txt_editor" rows="12" 
                                style="font-size: 0.9rem; line-height: 1.5; background-color: #f8f9fa;">{{ $settings['robots_txt'] ?? '' }}</textarea>
                        </div>
                        <div class="form-text">
                            <strong>Note:</strong> Be careful with <code>Disallow</code> rules as they can prevent your site from appearing in search results.
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.content._partials.form-actions', [
                'label' => 'Save SEO Settings'
            ])
        </div>
    </form>
@endsection

@section('page-style')
<style>
    .font-monospace {
        font-family: 'SFMono-Regular', Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace !important;
    }
</style>
@endsection
