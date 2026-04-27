@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Add Award')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
            <div class="card-header">
                <h5 class="mb-0">Add Award</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.awards.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">Title <span
                                    class="text-danger">*</span></label><input type="text" class="form-control" name="title"
                                value="{{ old('title') }}" required></div>
                        <div class="col-md-3 mb-3"><label class="form-label">Year</label><input type="text"
                                class="form-control" name="year" value="{{ old('year') }}" maxlength="10"></div>
                        <div class="col-md-3 mb-3"><label class="form-label">Tag</label><input type="text"
                                class="form-control" name="tag" value="{{ old('tag') }}"></div>
                    </div>
                    <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control"
                            name="description" rows="3">{{ old('description') }}</textarea></div>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">URL</label><input type="url"
                                class="form-control" name="url" value="{{ old('url') }}"></div>
                        <div class="col-md-3 mb-3"><label class="form-label">Order</label><input type="number"
                                class="form-control" name="order" value="{{ old('order', 0) }}"></div>
                        <div class="col-md-3 mb-3 d-flex align-items-end">
                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                    name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}><label
                                    class="form-check-label">Active</label></div>
                        </div>
                    </div>
                    @include('admin.content._partials.form-actions', [
                        'back_route' => route('admin.awards.index'),
                        'label' => 'Save Award'
                    ])
                </form>
            </div>
        </div>
    </div>
@endsection