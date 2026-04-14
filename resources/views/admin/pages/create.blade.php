@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Create Page')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages /</span> Create</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Create New Page</h5>
                <div class="card-body">
                    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="content">Content</label>
                                    <textarea name="content" id="editor"
                                        class="form-control ckeditor">{{ old('content') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="status">Status</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>
                                            Published</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="featured_image">Featured Image</label>
                                    <input class="form-control" type="file" id="featured_image" name="featured_image">
                                </div>

                                <hr>
                                <h6 class="mb-3">SEO Settings</h6>

                                <div class="mb-3">
                                    <label class="form-label" for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title"
                                        value="{{ old('meta_title') }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="meta_keywords">Meta Keywords</label>
                                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                        value="{{ old('meta_keywords') }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control"
                                        rows="3">{{ old('meta_description') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Save Page</button>
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary mt-3 ms-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    @include('admin._partials.ckeditor')
@endsection