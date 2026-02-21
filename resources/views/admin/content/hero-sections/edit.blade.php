@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Edit Hero Section')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Hero Section: {{ $heroSection->title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.hero-sections.update', $heroSection) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3"><label class="form-label">Title <span
                                        class="text-danger">*</span></label><input type="text" class="form-control"
                                    name="title" value="{{ old('title', $heroSection->title) }}" required></div>
                            <div class="mb-3"><label class="form-label">Subtitle</label><input type="text"
                                    class="form-control" name="subtitle"
                                    value="{{ old('subtitle', $heroSection->subtitle) }}"></div>
                            <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control"
                                    name="description"
                                    rows="4">{{ old('description', $heroSection->description) }}</textarea></div>
                            <div class="row">
                                <div class="col-md-6 mb-3"><label class="form-label">Button Text</label><input type="text"
                                        class="form-control" name="button_text"
                                        value="{{ old('button_text', $heroSection->button_text) }}"></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Button URL</label><input type="text"
                                        class="form-control" name="button_url"
                                        value="{{ old('button_url', $heroSection->button_url) }}"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3"><label class="form-label">Address</label><input type="text"
                                        class="form-control" name="address"
                                        value="{{ old('address', $heroSection->address) }}"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Phone</label><input type="text"
                                        class="form-control" name="phone" value="{{ old('phone', $heroSection->phone) }}">
                                </div>
                                <div class="col-md-4 mb-3"><label class="form-label">Email</label><input type="email"
                                        class="form-control" name="email" value="{{ old('email', $heroSection->email) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @include('admin.content._partials.image-preview', ['field' => 'image', 'existing' => $heroSection->image])
                            <div class="mb-3"><label class="form-label">Order</label><input type="number"
                                    class="form-control" name="order" value="{{ old('order', $heroSection->order) }}"></div>
                            <div class="mb-3">
                                <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                        name="status" value="1" {{ old('status', $heroSection->status) ? 'checked' : '' }}><label class="form-check-label">Active</label></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save me-1"></i> Update</button>
                        <a href="{{ route('admin.hero-sections.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection