@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Edit Blog Post')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Post: {{ $post->title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blog.update', $post) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3"><label class="form-label">Title <span
                                        class="text-danger">*</span></label><input type="text" class="form-control"
                                    name="title" value="{{ old('title', $post->title) }}" required></div>
                            <div class="mb-3"><label class="form-label">Category</label><select name="category_id"
                                    class="form-select">
                                    <option value="">Select</option>@foreach($categories as $cat)<option
                                    value="{{ $cat->id }}" {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>@endforeach
                                </select></div>
                            <div class="mb-3"><label class="form-label">Excerpt</label><textarea class="form-control"
                                    name="excerpt" rows="2">{{ old('excerpt', $post->excerpt) }}</textarea></div>
                            <div class="mb-3"><label class="form-label">Content <span
                                        class="text-danger">*</span></label><textarea class="form-control ckeditor"
                                    name="content" rows="10">{{ old('content', $post->content) }}</textarea></div>
                            <div class="mb-3"><label class="form-label">Tags</label><input type="text" class="form-control"
                                    name="tags[]" value="{{ $post->tags->pluck('title')->implode(',') }}"
                                    placeholder="laravel, web"></div>
                        </div>
                        <div class="col-md-4">
                            @include('admin.content._partials.image-preview', ['field' => 'image', 'existing' => $post->image])
                            @include('admin.content._partials.image-preview', ['field' => 'banner_image', 'existing' => $post->banner_image, 'label' => 'Details Page Banner Image'])
                            <div class="mb-3"><label class="form-label">Publish Date</label><input type="datetime-local"
                                    class="form-control" name="published_at"
                                    value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}"></div>
                            <div class="mb-3">
                                <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                        name="is_featured" value="1" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}><label class="form-check-label">Featured</label></div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                        name="status" value="1" {{ old('status', $post->status) ? 'checked' : '' }}><label
                                        class="form-check-label">Published</label></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6>SEO</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">Meta Title</label><input type="text"
                                class="form-control" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}">
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label">Meta Description</label><textarea
                                class="form-control" name="meta_description"
                                rows="2">{{ old('meta_description', $post->meta_description) }}</textarea></div>
                        <div class="col-12 mb-3">
                            <label class="form-label">FAQ & Search Schema (JSON-LD)</label>
                            <textarea class="form-control font-monospace" name="faq_schema_script" rows="4" placeholder='<script type="application/ld+json">...</script>'>{{ old('faq_schema_script', $post->faq_schema_script) }}</textarea>
                            <div class="form-text small">Paste JSON-LD script code here. <strong>Must include &lt;script&gt; tags.</strong></div>
                        </div>
                    </div>
                    <div class="mt-3"><button type="submit" class="btn btn-primary"><i class="bx bx-save me-1"></i>
                            Update</button> <a href="{{ route('admin.blog.index') }}"
                            class="btn btn-outline-secondary ms-2">Cancel</a></div>
                </form>
            </div>
        </div>
    </div>
    @include('admin._partials.ckeditor')
@endsection