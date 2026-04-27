@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Add Team Member')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
            <div class="card-header">
                <h5 class="mb-0">Add Team Member</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 mb-3"><label class="form-label">Name <span
                                            class="text-danger">*</span></label><input type="text" class="form-control"
                                        name="name" value="{{ old('name') }}" required></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Position <span
                                            class="text-danger">*</span></label><input type="text" class="form-control"
                                        name="position" value="{{ old('position') }}" required></div>
                            </div>
                            <div class="mb-3"><label class="form-label">Bio</label><textarea class="form-control" name="bio"
                                    rows="4">{{ old('bio') }}</textarea></div>
                            <div class="mb-3"><label class="form-label">Email</label><input type="email"
                                    class="form-control" name="email" value="{{ old('email') }}"></div>
                            <h6>Social Links</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3"><label class="form-label">LinkedIn</label><input type="url"
                                        class="form-control" name="social_links[linkedin]"
                                        value="{{ old('social_links.linkedin') }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Twitter</label><input type="url"
                                        class="form-control" name="social_links[twitter]"
                                        value="{{ old('social_links.twitter') }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">GitHub</label><input type="url"
                                        class="form-control" name="social_links[github]"
                                        value="{{ old('social_links.github') }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Website</label><input type="url"
                                        class="form-control" name="social_links[website]"
                                        value="{{ old('social_links.website') }}"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @include('admin.content._partials.image-preview', ['field' => 'image', 'existing' => null])
                            <div class="mb-3"><label class="form-label">Order</label><input type="number"
                                    class="form-control" name="order" value="{{ old('order', 0) }}"></div>
                            <div class="mb-3">
                                <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                        name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}><label
                                        class="form-check-label">Active</label></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6>SEO</h6>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold text-primary" for="meta_robots"><i class="bx bx-bot"></i> Search Engine Visibility</label>
                            <select name="meta_robots" id="meta_robots" class="form-select">
                                <option value="" {{ old('meta_robots') == '' ? 'selected' : '' }}>Default (Global Setting)</option>
                                <option value="INDEX,FOLLOW" {{ old('meta_robots') == 'INDEX,FOLLOW' ? 'selected' : '' }}>Index, Follow</option>
                                <option value="NOINDEX,FOLLOW" {{ old('meta_robots') == 'NOINDEX,FOLLOW' ? 'selected' : '' }}>Noindex, Follow</option>
                                <option value="NOINDEX,NOFOLLOW" {{ old('meta_robots') == 'NOINDEX,NOFOLLOW' ? 'selected' : '' }}>Noindex, Nofollow</option>
                            </select>
                            <div class="form-text small">Override the global search engine visibility for this specific team member.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea class="form-control" name="meta_description" rows="2">{{ old('meta_description') }}</textarea>
                        </div>
                    </div>
                    @include('admin.content._partials.form-actions', [
                        'back_route' => route('admin.team.index'),
                        'label' => 'Save Member'
                    ])
                </form>
            </div>
        </div>
    </div>
@endsection