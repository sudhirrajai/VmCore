@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Edit Project Category')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit: {{ $category->title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.project-categories.update', $category) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3"><label class="form-label">Title <span class="text-danger">*</span></label><input
                            type="text" class="form-control" name="title" value="{{ old('title', $category->title) }}"
                            required></div>
                    <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control"
                            name="description" rows="3">{{ old('description', $category->description) }}</textarea></div>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">Order</label><input type="number"
                                class="form-control" name="order" value="{{ old('order', $category->order) }}"></div>
                        <div class="col-md-6 mb-3 d-flex align-items-end">
                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                    name="status" value="1" {{ old('status', $category->status) ? 'checked' : '' }}><label
                                    class="form-check-label">Active</label></div>
                        </div>
                    </div>
                    @include('admin.content._partials.form-actions', [
                        'back_route' => route('admin.project-categories.index'),
                        'label' => 'Update Category'
                    ])
                </form>
            </div>
        </div>
    </div>
@endsection