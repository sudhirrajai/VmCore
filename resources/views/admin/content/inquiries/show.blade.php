@extends('admin.layouts.contentNavbarLayout')
@section('title', 'View Inquiry')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Inquiry from {{ $inquiry->name }}</h5>
                <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline-secondary"><i
                        class="bx bx-arrow-back me-1"></i> Back</a>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $inquiry->name }}</p>
                        <p><strong>Email:</strong> <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></p>
                        <p><strong>Phone:</strong> {{ $inquiry->phone ?? '—' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Subject:</strong> {{ $inquiry->subject ?? '—' }}</p>
                        <p><strong>Date:</strong> {{ $inquiry->created_at->format('M d, Y h:i A') }}</p>
                        <p><strong>Status:</strong> <span
                                class="badge bg-{{ $inquiry->is_read ? 'success' : 'warning' }}">{{ $inquiry->is_read ? 'Read' : 'Unread' }}</span>
                        </p>
                    </div>
                </div>

                <hr>
                <h6>Message</h6>
                <div class="p-3 bg-light rounded">
                    {!! nl2br(e($inquiry->message)) !!}
                </div>

                <div class="mt-4">
                    <a href="mailto:{{ $inquiry->email }}" class="btn btn-primary"><i class="bx bx-reply me-1"></i> Reply
                        via Email</a>
                    <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Delete this inquiry?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger ms-2"><i class="bx bx-trash me-1"></i>
                            Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection