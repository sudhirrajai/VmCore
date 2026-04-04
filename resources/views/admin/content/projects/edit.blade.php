@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Edit Project')

@section('page-style')
    {{-- Select2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Force standard multi-select highlights to be blue/white as fallback */
        select[multiple] option:checked {
            background: #0d6efd linear-gradient(0deg, #0d6efd 0%, #0d6efd 100%) !important;
            color: white !important;
        }
        
        /* Select2 Bootstrap 5 compatibility tweak */
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #d9dee3 !important;
            border-radius: 0.375rem !important;
            min-height: 38px !important;
            padding: 2px !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: {{ \App\Helpers\ThemeHelper::getPrimaryColor() }} !important;
            border-color: {{ \App\Helpers\ThemeHelper::getPrimaryColor() }} !important;
            color: #fff !important;
            padding: 2px 10px !important;
            margin-top: 4px !important;
            border-radius: 4px !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff !important;
            margin-right: 8px !important;
            border: none !important;
            background: transparent !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #eee !important;
            background: transparent !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Project: {{ $project->title }}</h5>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary btn-sm">Back to List</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" value="{{ old('title', $project->title) }}" required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Categories</label>
                                    <select name="categories[]" class="form-select select2" multiple id="project_categories">
                                        @php 
                                            // Ensure we are comparing strings to strings for reliable in_array
                                            $selectedCats = collect(old('categories', $project->categories->pluck('id')->toArray()))->map(fn($id) => (string)$id)->toArray();
                                        @endphp
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ in_array((string)$cat->id, $selectedCats) ? 'selected' : '' }}>
                                                {{ $cat->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Services</label>
                                    <select name="services[]" class="form-select select2" multiple id="project_services">
                                        @php 
                                            $selectedSvcs = collect(old('services', $project->services->pluck('id')->toArray()))->map(fn($id) => (string)$id)->toArray();
                                        @endphp
                                        @foreach($services as $svc)
                                            <option value="{{ $svc->id }}" {{ in_array((string)$svc->id, $selectedSvcs) ? 'selected' : '' }}>
                                                {{ $svc->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Short Description</label>
                                <textarea class="form-control" name="short_description" rows="2">{{ old('short_description', $project->short_description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Full Description</label>
                                <textarea class="form-control ckeditor" name="description" rows="5">{{ old('description', $project->description) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Client</label>
                                    <input type="text" class="form-control" name="client" value="{{ old('client', $project->client) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Project Date</label>
                                    <input type="date" class="form-control" name="project_date" 
                                        value="{{ old('project_date', ($project->project_date instanceof \DateTimeInterface) ? $project->project_date->format('Y-m-d') : '') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Project URL</label>
                                    <input type="url" class="form-control" name="project_url" value="{{ old('project_url', $project->project_url) }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tags</label>
                                <input type="text" class="form-control" name="tags[]" value="{{ $project->tags->pluck('title')->implode(',') }}" placeholder="web, design">
                            </div>

                            @if($project->images->count())
                                <div class="mb-3">
                                    <label class="form-label">Existing Gallery</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($project->images as $img)
                                            <div class="position-relative" style="width:80px;">
                                                <img src="{{ asset($img->image) }}" class="img-thumbnail" style="width:80px;height:80px;object-fit:cover;">
                                                <button type="button" class="btn btn-xs btn-danger position-absolute top-0 end-0"
                                                    onclick="deleteGalleryImage({{ $img->id }}, this)" style="font-size:10px;padding:2px 5px;">&times;</button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            @include('admin.content._partials.image-preview', ['field' => 'image', 'existing' => $project->image])
                            @include('admin.content._partials.image-preview', ['field' => 'banner_image', 'existing' => $project->banner_image, 'label' => 'Details Page Banner Image'])
                            <div class="mb-3">
                                <label class="form-label">Add Gallery Images</label>
                                <input type="file" class="form-control" name="gallery[]" multiple accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Order</label>
                                <input type="number" class="form-control" name="order" value="{{ old('order', $project->order) }}">
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label">Featured</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="status" value="1" {{ old('status', $project->status) ? 'checked' : '' }}>
                                    <label class="form-check-label">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h6>SEO</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title', $project->meta_title) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea class="form-control" name="meta_description" rows="2">{{ old('meta_description', $project->meta_description) }}</textarea>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save me-1"></i> Update</button>
                    </div>
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

@section('page-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // Use a self-executing function to avoid global namespace pollution and handle potential jQuery naming conflicts
        (function($) {
            'use strict';
            $(function() {
                // Check if select2 is loaded on the current jQuery instance
                if (typeof $.fn.select2 !== 'undefined') {
                    $('.select2').each(function() {
                        $(this).select2({
                            placeholder: "Select options",
                            width: '100%',
                            dropdownParent: $(this).parent()
                        });
                    });
                    console.log('Select2 initialized successfully');
                } else {
                    console.error('Select2 library not found or jQuery conflict occurred.');
                }
            });
        })(window.jQuery || jQuery || $);
    </script>
@endsection