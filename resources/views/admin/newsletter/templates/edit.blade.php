@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Edit Template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Newsletter / Templates /</span> Edit</h4>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Template Details</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.newsletter.templates.update', $template) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="name">Template Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name', $template->name) }}" placeholder="E.g. Monthly Update"
                                    required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="html_structure">HTML Structure (Optional)</label>
                                <textarea id="html_structure" name="html_structure"
                                    class="form-control @error('html_structure') is-invalid @enderror"
                                    rows="15">{{ old('html_structure', $template->html_structure) }}</textarea>
                                <div class="form-text">Enter base HTML. You can use this as a starting point when creating a
                                    newsletter.</div>
                                @error('html_structure')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update Template</button>
                            <a href="{{ route('admin.newsletter.templates.index') }}"
                                class="btn btn-label-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Load CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            ClassicEditor
                .create(document.querySelector('#html_structure'), {
                    licenseKey: ''
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection