@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Inquiries')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Contact Inquiries <span class="badge bg-danger ms-2">{{ $unreadCount }} unread</span></h5>
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3 mb-3">
                    <div class="col-auto"><input type="text" name="search" class="form-control"
                            placeholder="Search name/email..." value="{{ request('search') }}"></div>
                    <div class="col-auto">
                        <select name="status" class="form-select">
                            <option value="">All</option>
                            <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
                            <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                        </select>
                    </div>
                    <div class="col-auto"><button type="submit" class="btn btn-outline-primary"><i
                                class="bx bx-search"></i></button></div>
                </form>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr class="{{ !$item->is_read ? 'table-warning' : '' }}">
                                    <td>{{ $item->id }}</td>
                                    <td><strong>{{ $item->name }}</strong></td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ Str::limit($item->subject, 30) }}</td>
                                    <td><span
                                            class="badge bg-label-{{ $item->is_read ? 'success' : 'warning' }}">{{ $item->is_read ? 'Read' : 'New' }}</span>
                                    </td>
                                    <td>{{ $item->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.inquiries.show', $item) }}"
                                            class="btn btn-sm btn-outline-info"><i class="bx bx-show"></i></a>
                                        <form action="{{ route('admin.inquiries.destroy', $item) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button
                                                class="btn btn-sm btn-outline-danger"><i class="bx bx-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No inquiries yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $items->links() }}
            </div>
        </div>
    </div>
@endsection