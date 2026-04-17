@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Add Project')

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
                <h5 class="mb-0">Add New Project</h5>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary btn-sm">Back to List</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Categories</label>
                                    <select name="categories[]" class="form-select select2" multiple id="project_categories">
                                        @php 
                                            // Robust string-based selection logic
                                            $selectedCats = collect(old('categories', []))->map(fn($id) => (string)$id)->toArray();
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
                                            $selectedSvcs = collect(old('services', []))->map(fn($id) => (string)$id)->toArray();
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
                                <textarea class="form-control" name="short_description" rows="2">{{ old('short_description') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Story</label>
                                <textarea class="form-control ckeditor" name="description" rows="5">{{ old('description') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Dynamic Content (Optional)</label>
                                <textarea class="form-control ckeditor" name="dynamic_content" rows="10">{{ old('dynamic_content') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Client</label>
                                    <input type="text" class="form-control" name="client" value="{{ old('client') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Project Date</label>
                                    <input type="date" class="form-control" name="project_date" value="{{ old('project_date') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Project URL</label>
                                    <input type="url" class="form-control" name="project_url" value="{{ old('project_url') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tags (comma-separated)</label>
                                <input type="text" class="form-control" name="tags[]" value="{{ old('tags') ? implode(',', old('tags')) : '' }}" placeholder="web, design, app">
                            </div>
                        </div>

                        <div class="col-md-4">
                            @include('admin.content._partials.image-preview', ['field' => 'image', 'existing' => null])
                            @include('admin.content._partials.image-preview', ['field' => 'banner_image', 'existing' => null, 'label' => 'Details Page Banner Image'])

                            <div class="mb-3">
                                <label class="form-label">Order</label>
                                <input type="number" class="form-control" name="order" value="{{ old('order', 0) }}">
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label">Featured</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                                    <label class="form-check-label">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">Gallery Images</h6>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="addGalleryRow()">+ Add Image Pair</button>
                    </div>
                    <div class="mb-4" id="gallery_container">
                        @foreach(range(0, 0) as $i)
                        <div class="row mb-2 repeater-row align-items-end">
                            <div class="col-md-5">
                                <label class="form-label" style="font-size: 0.75rem;">Full Image *</label>
                                <input type="file" class="form-control" name="new_gallery[{{$i}}][image]" accept="image/*">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label" style="font-size: 0.75rem;">Thumbnail (Optional)</label>
                                <input type="file" class="form-control" name="new_gallery[{{$i}}][thumbnail]" accept="image/*">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-sm btn-danger mb-1" onclick="this.closest('.repeater-row').remove()">X</button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">Problem & Solution</h6>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="addRepeaterRow('problem_solution')">+ Add Item</button>
                    </div>
                    <div class="mb-4" id="problem_solution_container">
                        @foreach(range(0, 1) as $i)
                        <div class="row mb-2 repeater-row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="problem_solution[{{$i}}][title]" placeholder="Title (e.g. The Challenge)">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="problem_solution[{{$i}}][icon]" placeholder="SVG Code or Icon">
                            </div>
                            <div class="col-md-5">
                                <textarea class="form-control" name="problem_solution[{{$i}}][content]" placeholder="Description" rows="2"></textarea>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-sm btn-danger mt-1" onclick="this.closest('.repeater-row').remove()">X</button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">Feature Highlights</h6>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="addRepeaterRow('features')">+ Add Feature</button>
                    </div>
                    <div class="mb-4" id="features_container">
                        @foreach(range(0, 2) as $i)
                        <div class="row mb-2 repeater-row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="features[{{$i}}][title]" placeholder="Feature Title">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="features[{{$i}}][icon]" placeholder="SVG Code or Icon">
                            </div>
                            <div class="col-md-5">
                                <textarea class="form-control" name="features[{{$i}}][content]" placeholder="Feature Description" rows="2"></textarea>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-sm btn-danger mt-1" onclick="this.closest('.repeater-row').remove()">X</button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <hr>
                    <h6>SEO</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea class="form-control" name="meta_description" rows="2">{{ old('meta_description') }}</textarea>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save me-1"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin._partials.ckeditor')
@endsection

@section('page-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        (function($) {
            'use strict';
            $(function() {
                if (typeof $.fn.select2 !== 'undefined') {
                    $('.select2').each(function() {
                        $(this).select2({
                            placeholder: "Select options",
                            width: '100%',
                            dropdownParent: $(this).parent()
                        });
                    });
                }
            });
        })(window.jQuery || jQuery || $);

        function addRepeaterRow(prefix) {
            const container = document.getElementById(prefix + '_container');
            const idx = Date.now();
            const template = `
                <div class="row mb-2 repeater-row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="${prefix}[${idx}][title]" placeholder="Title">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="${prefix}[${idx}][icon]" placeholder="SVG Code or Icon">
                    </div>
                    <div class="col-md-5">
                        <textarea class="form-control" name="${prefix}[${idx}][content]" placeholder="Description" rows="2"></textarea>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-sm btn-danger mt-1" onclick="this.closest('.repeater-row').remove()">X</button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', template);
        }

        function addGalleryRow() {
            const container = document.getElementById('gallery_container');
            const idx = Date.now();
            const template = `
                <div class="row mb-2 repeater-row align-items-end">
                    <div class="col-md-5">
                        <label class="form-label" style="font-size: 0.75rem;">Full Image *</label>
                        <input type="file" class="form-control" name="new_gallery[${idx}][image]" accept="image/*">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label" style="font-size: 0.75rem;">Thumbnail (Optional)</label>
                        <input type="file" class="form-control" name="new_gallery[${idx}][thumbnail]" accept="image/*">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-sm btn-danger mb-1" onclick="this.closest('.repeater-row').remove()">X</button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', template);
        }
    </script>
@endsection