@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Blog Categories')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Blog Categories</h5>
                <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-primary"><i
                        class="bx bx-plus me-1"></i> Add</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Posts</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><strong>{{ $item->title }}</strong></td>
                                    <td><span class="badge bg-label-info">{{ $item->posts_count }}</span></td>
                                    <td>{{ $item->order }}</td>
                                    <td>@include('admin.content._partials.status-toggle', ['item' => $item, 'route' => 'admin.blog-categories.toggle-status'])
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.blog-categories.edit', $item) }}"
                                            class="btn btn-sm btn-outline-primary"><i class="bx bx-edit"></i></a>
                                        <form action="{{ route('admin.blog-categories.destroy', $item) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button
                                                class="btn btn-sm btn-outline-danger"><i class="bx bx-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No categories.</td>
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