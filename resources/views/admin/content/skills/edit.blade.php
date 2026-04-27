@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Edit Skill')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Skill: {{ $skill->title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.skills.update', $skill) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">Title <span
                                    class="text-danger">*</span></label><input type="text" class="form-control" name="title"
                                value="{{ old('title', $skill->title) }}" required></div>
                        <div class="col-md-3 mb-3"><label class="form-label">Percentage <span
                                    class="text-danger">*</span></label><input type="number" class="form-control"
                                name="percentage" min="0" max="100" value="{{ old('percentage', $skill->percentage) }}"
                                required></div>
                        <div class="col-md-3 mb-3"><label class="form-label">Order</label><input type="number"
                                class="form-control" name="order" value="{{ old('order', $skill->order) }}"></div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="status"
                                value="1" {{ old('status', $skill->status) ? 'checked' : '' }}><label
                                class="form-check-label">Active</label></div>
                    </div>
                    @include('admin.content._partials.form-actions', [
                        'back_route' => route('admin.skills.index'),
                        'label' => 'Update Skill'
                    ])
                </form>
            </div>
        </div>
    </div>
@endsection