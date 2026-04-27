@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Edit Subscriber')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Newsletter / Subscribers /</span> Edit</h4>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Subscriber Details</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.newsletter.subscribers.update', $subscriber) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="name">Name (Optional)</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name', $subscriber->name) }}" placeholder="John Doe">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Email Address <span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email', $subscriber->email) }}"
                                    placeholder="john@example.com" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3 form-check">
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $subscriber->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active (Subscribed)
                                </label>
                            </div>
                            @include('admin.content._partials.form-actions', [
                                'back_route' => route('admin.newsletter.subscribers.index'),
                                'label' => 'Update Subscriber'
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection