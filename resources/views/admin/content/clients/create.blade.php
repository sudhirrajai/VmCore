@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Add Client')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Add Client</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">Name <span
                                    class="text-danger">*</span></label><input type="text" class="form-control" name="name"
                                value="{{ old('name') }}" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label">URL</label><input type="url"
                                class="form-control" name="url" value="{{ old('url') }}"></div>
                    </div>
                    @include('admin.content._partials.image-preview', ['field' => 'logo', 'existing' => null])
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">Order</label><input type="number"
                                class="form-control" name="order" value="{{ old('order', 0) }}"></div>
                        <div class="col-md-6 mb-3 d-flex align-items-end">
                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                    name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}><label
                                    class="form-check-label">Active</label></div>
                        </div>
                    </div>
                    @include('admin.content._partials.form-actions', [
                        'back_route' => route('admin.clients.index'),
                        'label' => 'Save Client'
                    ])
                </form>
            </div>
        </div>
    </div>
@endsection