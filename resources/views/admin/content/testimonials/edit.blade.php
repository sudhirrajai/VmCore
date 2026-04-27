@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Edit Testimonial')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Testimonial: {{ $testimonial->name }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4 mb-3"><label class="form-label">Name <span
                                            class="text-danger">*</span></label><input type="text" class="form-control"
                                        name="name" value="{{ old('name', $testimonial->name) }}" required></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Designation</label><input type="text"
                                        class="form-control" name="designation"
                                        value="{{ old('designation', $testimonial->designation) }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Company</label><input type="text"
                                        class="form-control" name="company"
                                        value="{{ old('company', $testimonial->company) }}"></div>
                            </div>
                            <div class="mb-3"><label class="form-label">Content <span
                                        class="text-danger">*</span></label><textarea class="form-control" name="content"
                                    rows="4">{{ old('content', $testimonial->content) }}</textarea></div>
                            <div class="row">
                                <div class="col-md-4 mb-3"><label class="form-label">Rating</label><select name="rating"
                                        class="form-select">@for($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>@endfor
                                    </select></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Project</label><select
                                        name="project_id" class="form-select">
                                        <option value="">None</option>@foreach($projects as $p)<option value="{{ $p->id }}"
                                            {{ old('project_id', $testimonial->project_id) == $p->id ? 'selected' : '' }}>
                                        {{ $p->title }}</option>@endforeach
                                    </select></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Team Member</label><select
                                        name="team_member_id" class="form-select">
                                        <option value="">None</option>@foreach($teamMembers as $m)<option
                                            value="{{ $m->id }}" {{ old('team_member_id', $testimonial->team_member_id) == $m->id ? 'selected' : '' }}>{{ $m->name }}
                                        </option>@endforeach
                                    </select></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @include('admin.content._partials.image-preview', ['field' => 'image', 'existing' => $testimonial->image])
                            <div class="mb-3"><label class="form-label">Order</label><input type="number"
                                    class="form-control" name="order" value="{{ old('order', $testimonial->order) }}"></div>
                            <div class="mb-3">
                                <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                        name="status" value="1" {{ old('status', $testimonial->status) ? 'checked' : '' }}><label class="form-check-label">Active</label></div>
                            </div>
                        </div>
                    </div>
                    @include('admin.content._partials.form-actions', [
                        'back_route' => route('admin.testimonials.index'),
                        'label' => 'Update Testimonial'
                    ])
                </form>
            </div>
        </div>
    </div>
@endsection