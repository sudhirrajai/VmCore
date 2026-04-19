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
                                <label class="form-label">Story</label>
                                <textarea class="form-control ckeditor" name="description" rows="5">{{ old('description', $project->description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Dynamic Content (Optional)</label>
                                <textarea class="form-control ckeditor" name="dynamic_content" rows="10">{{ old('dynamic_content', $project->dynamic_content) }}</textarea>
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

                        </div>

                        <div class="col-md-4">
                            @include('admin.content._partials.image-preview', ['field' => 'image', 'existing' => $project->image])
                            @include('admin.content._partials.image-preview', ['field' => 'banner_image', 'existing' => $project->banner_image, 'label' => 'Details Page Banner Image'])
                            @include('admin.content._partials.image-preview', ['field' => 'banner_image', 'existing' => $project->banner_image, 'label' => 'Details Page Banner Image'])

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
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">Gallery Images</h6>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="addGalleryRow()">+ Add Image Pair</button>
                    </div>
                    
                    @if($project->images->count())
                        <div class="mb-4">
                            <label class="form-label text-muted small">Update Existing Images</label>
                            @foreach($project->images as $img)
                                <div class="row mb-3 align-items-center border p-2 rounded position-relative" style="border-color: #d9dee3 !important;">
                                    <div class="col-md-2 text-center">
                                        <img src="{{ asset($img->image) }}" class="img-thumbnail d-block mx-auto mb-1" style="height: 60px; object-fit: cover;">
                                        <div style="font-size: 0.65rem;" class="text-muted">Full Image</div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <img src="{{ asset($img->thumbnail ?? $img->image) }}" class="img-thumbnail d-block mx-auto mb-1" style="height: 60px; object-fit: cover;">
                                        <div style="font-size: 0.65rem;" class="text-muted">Thumbnail</div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" style="font-size: 0.75rem;">Change Full Image</label>
                                        <input type="file" class="form-control form-control-sm" name="existing_gallery[{{ $img->id }}][image]" accept="image/*">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" style="font-size: 0.75rem;">Change Thumbnail</label>
                                        <input type="file" class="form-control form-control-sm" name="existing_gallery[{{ $img->id }}][thumbnail]" accept="image/*">
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label" style="font-size: 0.75rem;">Order</label>
                                        <input type="number" class="form-control form-control-sm" name="existing_gallery[{{ $img->id }}][order]" value="{{ $img->order }}">
                                    </div>
                                    <div class="col-md-1 text-end">
                                        <button type="button" class="btn btn-sm btn-danger mt-3" onclick="deleteGalleryImage({{ $img->id }}, this)">X</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mb-4" id="gallery_container">
                        <!-- New image rows will be added here -->
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">Problem & Solution</h6>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="addRepeaterRow('problem_solution')">+ Add Item</button>
                    </div>
                    <div class="mb-4" id="problem_solution_container">
                        @php $ps = old('problem_solution', $project->problem_solution ?? []); @endphp
                        @foreach(array_pad((array)$ps, 2, []) as $i => $item)
                        <div class="row mb-2 repeater-row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="problem_solution[{{ $i }}][title]" placeholder="Title (e.g. The Challenge)" value="{{ $item['title'] ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="problem_solution[{{ $i }}][icon]" placeholder="SVG Code or Icon" value="{{ $item['icon'] ?? '' }}">
                            </div>
                            <div class="col-md-5">
                                <textarea class="form-control" name="problem_solution[{{ $i }}][content]" placeholder="Description" rows="2">{{ $item['content'] ?? '' }}</textarea>
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
                        @php $fh = old('features', $project->features ?? []); @endphp
                        @foreach(array_pad((array)$fh, 4, []) as $i => $item)
                        <div class="row mb-2 repeater-row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="features[{{ $i }}][title]" placeholder="Feature Title" value="{{ $item['title'] ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="features[{{ $i }}][icon]" placeholder="SVG Code or Icon" value="{{ $item['icon'] ?? '' }}">
                            </div>
                            <div class="col-md-5">
                                <textarea class="form-control" name="features[{{ $i }}][content]" placeholder="Feature Description" rows="2">{{ $item['content'] ?? '' }}</textarea>
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
                            <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title', $project->meta_title) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea class="form-control" name="meta_description" rows="2">{{ old('meta_description', $project->meta_description) }}</textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">FAQ & Search Schema (JSON-LD)</label>
                            <textarea class="form-control font-monospace" name="faq_schema_script" rows="4" placeholder='<script type="application/ld+json">...</script>'>{{ old('faq_schema_script', $project->faq_schema_script) }}</textarea>
                            <div class="form-text small">Paste JSON-LD script code here. <strong>Must include &lt;script&gt; tags.</strong></div>
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
                <div class="row mb-2 repeater-row align-items-end p-2 border rounded" style="border-color: #d9dee3 !important;">
                    <div class="col-md-4">
                        <label class="form-label" style="font-size: 0.75rem;">Full Image *</label>
                        <input type="file" class="form-control form-control-sm" name="new_gallery[${idx}][image]" accept="image/*">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" style="font-size: 0.75rem;">Thumbnail (Optional)</label>
                        <input type="file" class="form-control form-control-sm" name="new_gallery[${idx}][thumbnail]" accept="image/*">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label" style="font-size: 0.75rem;">Order</label>
                        <input type="number" class="form-control form-control-sm" name="new_gallery[${idx}][order]" value="0">
                    </div>
                    <div class="col-md-2 text-end">
                        <button type="button" class="btn btn-sm btn-danger mb-1" onclick="this.closest('.repeater-row').remove()">X</button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', template);
        }
    </script>
@endsection