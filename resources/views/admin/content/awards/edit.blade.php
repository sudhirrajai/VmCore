@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Edit Award')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit: {{ $award->title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.awards.update', $award) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">Title <span
                                    class="text-danger">*</span></label><input type="text" class="form-control" name="title"
                                value="{{ old('title', $award->title) }}" required></div>
                        <div class="col-md-3 mb-3"><label class="form-label">Year</label><input type="text"
                                class="form-control" name="year" value="{{ old('year', $award->year) }}" maxlength="10">
                        </div>
                        <div class="col-md-3 mb-3"><label class="form-label">Tag</label><input type="text"
                                class="form-control" name="tag" value="{{ old('tag', $award->tag) }}"></div>
                    </div>
                    <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control"
                            name="description" rows="3">{{ old('description', $award->description) }}</textarea></div>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">URL</label><input type="url"
                                class="form-control" name="url" value="{{ old('url', $award->url) }}"></div>
                        <div class="col-md-3 mb-3"><label class="form-label">Order</label><input type="number"
                                class="form-control" name="order" value="{{ old('order', $award->order) }}"></div>
                        <div class="col-md-3 mb-3 d-flex align-items-end">
                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                    name="status" value="1" {{ old('status', $award->status) ? 'checked' : '' }}><label
                                    class="form-check-label">Active</label></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bx bx-save me-1"></i> Update</button>
                    <a href="{{ route('admin.awards.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection