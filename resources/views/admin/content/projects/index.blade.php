@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Projects')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Projects</h5>
                <a href="{{ route('admin.projects.create') }}" class="btn btn-primary"><i class="bx bx-plus me-1"></i> Add
                    Project</a>
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3 mb-3">
                    <div class="col-auto"><input type="text" name="search" class="form-control" placeholder="Search..."
                            value="{{ request('search') }}"></div>
                    <div class="col-auto">
                        <select name="category_id" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)<option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>@endforeach
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
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Featured</th>
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
                                    <td><strong>{{ $item->title }}</strong></td>
                                    <td>{{ $item->category->title ?? '—' }}</td>
                                    <td><span
                                            class="badge bg-label-{{ $item->is_featured ? 'warning' : 'secondary' }}">{{ $item->is_featured ? 'Yes' : 'No' }}</span>
                                    </td>
                                    <td>@include('admin.content._partials.status-toggle', ['item' => $item, 'route' => 'admin.projects.toggle-status'])
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.projects.edit', $item) }}"
                                            class="btn btn-sm btn-outline-primary"><i class="bx bx-edit"></i></a>
                                        <form action="{{ route('admin.projects.destroy', $item) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger global-delete-btn">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No projects found.</td>
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