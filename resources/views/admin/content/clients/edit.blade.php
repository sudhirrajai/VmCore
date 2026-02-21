@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Edit Client')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit: {{ $client->name }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.clients.update', $client) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">Name <span
                                    class="text-danger">*</span></label><input type="text" class="form-control" name="name"
                                value="{{ old('name', $client->name) }}" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label">URL</label><input type="url"
                                class="form-control" name="url" value="{{ old('url', $client->url) }}"></div>
                    </div>
                    @include('admin.content._partials.image-preview', ['field' => 'logo', 'existing' => $client->logo])
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">Order</label><input type="number"
                                class="form-control" name="order" value="{{ old('order', $client->order) }}"></div>
                        <div class="col-md-6 mb-3 d-flex align-items-end">
                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                    name="status" value="1" {{ old('status', $client->status) ? 'checked' : '' }}><label
                                    class="form-check-label">Active</label></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bx bx-save me-1"></i> Update</button>
                    <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection