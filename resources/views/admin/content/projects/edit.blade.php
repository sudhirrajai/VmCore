@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Edit Project')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Project: {{ $project->title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3"><label class="form-label">Title <span
                                        class="text-danger">*</span></label><input type="text" class="form-control"
                                    name="title" value="{{ old('title', $project->title) }}" required></div>
                            <div class="row">
                                <div class="col-md-6 mb-3"><label class="form-label">Category</label><select
                                        name="category_id" class="form-select">
                                        <option value="">Select</option>@foreach($categories as $cat)<option
                                        value="{{ $cat->id }}" {{ old('category_id', $project->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>@endforeach
                                    </select></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Service</label><select
                                        name="service_id" class="form-select">
                                        <option value="">Select</option>@foreach($services as $svc)<option
                                        value="{{ $svc->id }}" {{ old('service_id', $project->service_id) == $svc->id ? 'selected' : '' }}>{{ $svc->title }}</option>@endforeach
                                    </select></div>
                            </div>
                            <div class="mb-3"><label class="form-label">Short Description</label><textarea
                                    class="form-control" name="short_description"
                                    rows="2">{{ old('short_description', $project->short_description) }}</textarea></div>
                            <div class="mb-3"><label class="form-label">Full Description</label><textarea
                                    class="form-control ckeditor" name="description"
                                    rows="5">{{ old('description', $project->description) }}</textarea></div>
                            <div class="row">
                                <div class="col-md-4 mb-3"><label class="form-label">Client</label><input type="text"
                                        class="form-control" name="client" value="{{ old('client', $project->client) }}">
                                </div>
                                <div class="col-md-4 mb-3"><label class="form-label">Project Date</label><input type="date"
                                        class="form-control" name="project_date"
                                        value="{{ old('project_date', $project->project_date?->format('Y-m-d')) }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Project URL</label><input type="url"
                                        class="form-control" name="project_url"
                                        value="{{ old('project_url', $project->project_url) }}"></div>
                            </div>
                            <div class="mb-3"><label class="form-label">Tags</label><input type="text" class="form-control"
                                    name="tags[]" value="{{ $project->tags->pluck('title')->implode(',') }}"
                                    placeholder="web, design"></div>
                            @if($project->images->count())
                                <div class="mb-3">
                                    <label class="form-label">Existing Gallery</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($project->images as $img)
                                            <div class="position-relative" style="width:80px;">
                                                <img src="{{ asset($img->image) }}" class="img-thumbnail"
                                                    style="width:80px;height:80px;object-fit:cover;">
                                                <button type="button" class="btn btn-xs btn-danger position-absolute top-0 end-0"
                                                    onclick="deleteGalleryImage({{ $img->id }}, this)"
                                                    style="font-size:10px;padding:2px 5px;">&times;</button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            @include('admin.content._partials.image-preview', ['field' => 'image', 'existing' => $project->image])
                            @include('admin.content._partials.image-preview', ['field' => 'banner_image', 'existing' => $project->banner_image, 'label' => 'Details Page Banner Image'])
                            <div class="mb-3"><label class="form-label">Add Gallery Images</label><input type="file"
                                    class="form-control" name="gallery[]" multiple accept="image/*"></div>
                            <div class="mb-3"><label class="form-label">Order</label><input type="number"
                                    class="form-control" name="order" value="{{ old('order', $project->order) }}"></div>
                            <div class="mb-3">
                                <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                        name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}><label class="form-check-label">Featured</label></div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                        name="status" value="1" {{ old('status', $project->status) ? 'checked' : '' }}><label class="form-check-label">Active</label></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6>SEO</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">Meta Title</label><input type="text"
                                class="form-control" name="meta_title"
                                value="{{ old('meta_title', $project->meta_title) }}"></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Meta Description</label><textarea
                                class="form-control" name="meta_description"
                                rows="2">{{ old('meta_description', $project->meta_description) }}</textarea></div>
                    </div>
                    <div class="mt-3"><button type="submit" class="btn btn-primary"><i class="bx bx-save me-1"></i>
                            Update</button> <a href="{{ route('admin.projects.index') }}"
                            class="btn btn-outline-secondary ms-2">Cancel</a></div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function deleteGalleryImage(id, btn) {
            if (!confirm('Delete this image?')) return;
            fetch('{{ url("admin/projects/gallery") }}/' + id, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
                .then(r => r.json()).then(d => { if (d.success) btn.closest('.position-relative').remove(); });
        }
    </script>
    @include('admin._partials.ckeditor')
@endsection