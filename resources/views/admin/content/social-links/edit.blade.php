@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Edit Social Link')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit: {{ $socialLink->platform }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.social-links.update', $socialLink) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mb-3"><label class="form-label">Platform <span
                                    class="text-danger">*</span></label><input type="text" class="form-control"
                                name="platform" value="{{ old('platform', $socialLink->platform) }}" required></div>
                        <div class="col-md-4 mb-3"><label class="form-label">URL <span
                                    class="text-danger">*</span></label><input type="url" class="form-control" name="url"
                                value="{{ old('url', $socialLink->url) }}" required></div>
                        <div class="col-md-4 mb-3"><label class="form-label">Icon Class</label><input type="text"
                                class="form-control" name="icon" value="{{ old('icon', $socialLink->icon) }}"
                                placeholder="e.g. bx bxl-facebook"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">Order</label><input type="number"
                                class="form-control" name="order" value="{{ old('order', $socialLink->order) }}"></div>
                        <div class="col-md-6 mb-3 d-flex align-items-end">
                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                    name="status" value="1" {{ old('status', $socialLink->status) ? 'checked' : '' }}><label
                                    class="form-check-label">Active</label></div>
                        </div>
                    </div>
                    @include('admin.content._partials.form-actions', [
                        'back_route' => route('admin.social-links.index'),
                        'label' => 'Update Social Link'
                    ])
                </form>
            </div>
        </div>
    </div>
@endsection