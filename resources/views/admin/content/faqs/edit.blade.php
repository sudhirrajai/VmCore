@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Edit FAQ')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit FAQ</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3"><label class="form-label">Question <span class="text-danger">*</span></label><input
                            type="text" class="form-control" name="question" value="{{ old('question', $faq->question) }}"
                            required></div>
                    <div class="mb-3"><label class="form-label">Answer <span class="text-danger">*</span></label><textarea
                            class="form-control" name="answer" rows="5">{{ old('answer', $faq->answer) }}</textarea></div>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">Order</label><input type="number"
                                class="form-control" name="order" value="{{ old('order', $faq->order) }}"></div>
                        <div class="col-md-6 mb-3 d-flex align-items-end">
                            <div class="form-check form-switch"><input class="form-check-input" type="checkbox"
                                    name="status" value="1" {{ old('status', $faq->status) ? 'checked' : '' }}><label
                                    class="form-check-label">Active</label></div>
                        </div>
                    </div>
                    @include('admin.content._partials.form-actions', [
                        'back_route' => route('admin.faqs.index'),
                        'label' => 'Update FAQ'
                    ])
                </form>
            </div>
        </div>
    </div>
@endsection