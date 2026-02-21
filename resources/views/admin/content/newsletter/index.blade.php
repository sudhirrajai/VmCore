@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Newsletter Subscribers')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Newsletter Subscribers <span class="badge bg-primary ms-2">{{ $items->total() }}</span>
                </h5>
                <a href="{{ route('admin.newsletter.export') }}" class="btn btn-success"><i class="bx bx-download me-1"></i>
                    Export CSV</a>
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3 mb-3">
                    <div class="col-auto"><input type="text" name="search" class="form-control"
                            placeholder="Search email..." value="{{ request('search') }}"></div>
                    <div class="col-auto"><button type="submit" class="btn btn-outline-primary"><i
                                class="bx bx-search"></i></button></div>
                </form>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Subscribed</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><strong>{{ $item->email }}</strong></td>
                                    <td>{{ $item->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.newsletter.destroy', $item) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Remove subscriber?')">@csrf
                                            @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i
                                                    class="bx bx-trash"></i></button></form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">No subscribers yet.</td>
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