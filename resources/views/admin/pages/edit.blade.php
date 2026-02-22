@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Edit Page')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages /</span> Edit</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Edit Page: {{ $page->title }}</h5>
                <div class="card-body">
                    <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title', $page->title) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="slug">Slug (Auto-generated if left blank but here you can
                                        edit it)</label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        value="{{ old('slug', $page->slug) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="content">Content</label>
                                    <textarea name="content" id="editor"
                                        class="form-control">{{ old('content', $page->content) }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="status">Status</label>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="draft" {{ old('status', $page->status->value) == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status', $page->status->value) == 'published' ? 'selected' : '' }}>Published</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="featured_image">Featured Image</label>
                                    <input class="form-control mb-2" type="file" id="featured_image" name="featured_image">
                                    @if($page->featured_image)
                                        <img src="{{ asset($page->featured_image) }}" alt="Featured" class="img-thumbnail mt-2"
                                            width="100">
                                    @endif
                                </div>

                                <hr>
                                <h6 class="mb-3">SEO Settings</h6>

                                <div class="mb-3">
                                    <label class="form-label" for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title"
                                        value="{{ old('meta_title', $page->meta_title) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="meta_keywords">Meta Keywords</label>
                                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                        value="{{ old('meta_keywords', $page->meta_keywords) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control"
                                        rows="3">{{ old('meta_description', $page->meta_description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Update Page</button>
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary mt-3 ms-2">Cancel</a>
                        <a href="{{ url($page->slug) }}" target="_blank" class="btn btn-outline-info mt-3 ms-2">Preview</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        class Base64UploadAdapter {
            constructor(loader) { this.loader = loader; }
            upload() {
                return this.loader.file.then(file => new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.onload = () => resolve({ default: reader.result });
                    reader.onerror = error => reject(error);
                    reader.readAsDataURL(file);
                }));
            }
            abort() { }
        }

        function Base64UploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new Base64UploadAdapter(loader);
            };
        }

        ClassicEditor
            .create(document.querySelector('#editor'), {
                extraPlugins: [Base64UploadAdapterPlugin]
            })
            .catch(error => { console.error(error); });
    </script>
@endsection