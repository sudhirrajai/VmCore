@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Add Project Category')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Add Project Category</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.project-categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3"><label class="form-label">Title <span class="text-danger">*</span></label><input
                            type="text" class="form-control" name="title" value="{{ old('title') }}" required></div>
                    <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control"
                            name="description" rows="3">{{ old('description') }}</textarea></div>
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
                        'back_route' => route('admin.project-categories.index'),
                        'label' => 'Save Category'
                    ])
                </form>
            </div>
        </div>
    </div>
@endsection