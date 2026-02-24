@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Newsletter Subscribers')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span>Newsletter /</span> Subscribers</h4>
            <div>
                <a href="{{ route('admin.newsletter.subscribers.import.form') }}" class="btn btn-secondary me-2">
                    <i class="ti ti-upload me-1"></i> Import CSV
                </a>
                <a href="{{ route('admin.newsletter.subscribers.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Add Subscriber
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($subscribers as $subscriber)
                            <tr>
                                <td>{{ $subscriber->id }}</td>
                                <td>{{ $subscriber->name ?? 'N/A' }}</td>
                                <td>{{ $subscriber->email }}</td>
                                <td>
                                    @if($subscriber->is_active)
                                        <span class="badge bg-label-success">Active</span>
                                    @else
                                        <span class="badge bg-label-danger"
                                            title="Unsubscribed on: {{ $subscriber->unsubscribed_at }}">Unsubscribed</span>
                                    @endif
                                </td>
                                <td>{{ $subscriber->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-primary"
                                        href="{{ route('admin.newsletter.subscribers.edit', $subscriber) }}" title="Edit">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.newsletter.subscribers.destroy', $subscriber) }}"
                                        method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger global-delete-btn"
                                            title="Delete">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No subscribers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $subscribers->links() }}
        </div>
    </div>
@endsection