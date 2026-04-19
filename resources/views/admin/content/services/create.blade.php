@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Add Service')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Add New Service</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="short_description">Short Description</label>
                                <textarea class="form-control" id="short_description" name="short_description"
                                    rows="2">{{ old('short_description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="description">Full Description</label>
                                <textarea class="form-control ckeditor" id="description" name="description"
                                    rows="6">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            @include('admin.content._partials.image-preview', ['field' => 'image', 'existing' => null])
                            @include('admin.content._partials.image-preview', ['field' => 'banner_image', 'existing' => null, 'label' => 'Details Page Banner Image'])

                            <div class="mb-3">
                                <label class="form-label" for="icon">Icon Class (e.g. bx bx-code)</label>
                                <input type="text" class="form-control" id="icon" name="icon" value="{{ old('icon') }}">
                            </div>

                            <div class="mb-3"><label class="form-label">Tags</label><input type="text" class="form-control"
                                    name="tags[]" value="" placeholder="web, design"></div>

                            <div class="mb-3">
                                <label class="form-label" for="order">Display Order</label>
                                <input type="number" class="form-control" id="order" name="order"
                                    value="{{ old('order', 0) }}">
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h6>SEO Settings</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title"
                                    value="{{ old('meta_title') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="meta_description">Meta Description</label>
                                <textarea class="form-control" id="meta_description" name="meta_description"
                                    rows="2">{{ old('meta_description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label" for="faq_schema_script">FAQ & Search Schema (JSON-LD)</label>
                            <textarea class="form-control font-monospace" id="faq_schema_script" name="faq_schema_script"
                                rows="4" placeholder='<script type="application/ld+json">...</script>'>{{ old('faq_schema_script') }}</textarea>
                            <div class="form-text">Paste JSON-LD script code here. <strong>Must include &lt;script&gt; tags.</strong></div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save me-1"></i> Save Service</button>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin._partials.ckeditor')
@endsection