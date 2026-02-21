@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Blog Posts')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Blog Posts</h5>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary"><i class="bx bx-plus me-1"></i> New
                    Post</a>
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3 mb-3">
                    <div class="col-auto"><input type="text" name="search" class="form-control" placeholder="Search..."
                            value="{{ request('search') }}"></div>
                    <div class="col-auto"><button type="submit" class="btn btn-outline-primary"><i
                                class="bx bx-search"></i></button></div>
                </form>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>@if($item->image)<img src="{{ asset($item->image) }}" class="rounded" width="50"
                                    height="50" style="object-fit:cover;">@else <span
                                            class="badge bg-label-secondary">—</span> @endif</td>
                                    <td><strong>{{ Str::limit($item->title, 40) }}</strong></td>
                                    <td>{{ $item->category->title ?? '—' }}</td>
                                    <td>{{ $item->author->name ?? '—' }}</td>
                                    <td>@include('admin.content._partials.status-toggle', ['item' => $item, 'route' => 'admin.blog.toggle-status'])
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.blog.edit', $item) }}"
                                            class="btn btn-sm btn-outline-primary"><i class="bx bx-edit"></i></a>
                                        <form action="{{ route('admin.blog.destroy', $item) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button
                                                class="btn btn-sm btn-outline-danger"><i class="bx bx-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No posts. <a
                                            href="{{ route('admin.blog.create') }}">Write one</a></td>
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