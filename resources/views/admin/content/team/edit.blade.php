@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Edit Team Member')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit: {{ $member->name }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.team.update', $member) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 mb-3"><label class="form-label">Name <span
                                            class="text-danger">*</span></label><input type="text" class="form-control"
                                        name="name" value="{{ old('name', $member->name) }}" required></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Position <span
                                            class="text-danger">*</span></label><input type="text" class="form-control"
                                        name="position" value="{{ old('position', $member->position) }}" required></div>
                            </div>
                            <div class="mb-3"><label class="form-label">Bio</label><textarea class="form-control" name="bio"
                                    rows="4">{{ old('bio', $member->bio) }}</textarea></div>
                            <div class="mb-3"><label class="form-label">Email</label><input type="email"
                                    class="form-control" name="email" value="{{ old('email', $member->email) }}"></div>
                            <h6>Social Links</h6>
                            @php $social = $member->social_links ?? []; @endphp
                            <div class="row">
                                <div class="col-md-6 mb-3"><label class="form-label">LinkedIn</label><input type="url"
                                        class="form-control" name="social_links[linkedin]"
                                        value="{{ old('social_links.linkedin', $social['linkedin'] ?? '') }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Twitter</label><input type="url"
                                        class="form-control" name="social_links[twitter]"
                                        value="{{ old('social_links.twitter', $social['twitter'] ?? '') }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">GitHub</label><input type="url"
                                        class="form-control" name="social_links[github]"
                                        value="{{ old('social_links.github', $social['github'] ?? '') }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Website</label><input type="url"
                                        class="form-control" name="social_links[website]"
                                        value="{{ old('social_links.website', $social['website'] ?? '') }}"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @include('admin.content._partials.image-preview', ['field' => 'image', 'existing' => $member->image])
                            <div class="mb-3"><label class="form-label">Order</label><input type="number"
                                    class="form-control" name="order" value="{{ old('order', $member->order) }}"></div>
                            <div class="mb-3">
                                <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                        name="status" value="1" {{ old('status', $member->status) ? 'checked' : '' }}><label
                                        class="form-check-label">Active</label></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3"><button type="submit" class="btn btn-primary"><i class="bx bx-save me-1"></i>
                            Update</button> <a href="{{ route('admin.team.index') }}"
                            class="btn btn-outline-secondary ms-2">Cancel</a></div>
                </form>
            </div>
        </div>
    </div>
@endsection