@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Project Categories')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Project Categories</h5>
                <a href="{{ route('admin.project-categories.create') }}" class="btn btn-primary"><i
                        class="bx bx-plus me-1"></i> Add</a>
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3 mb-3">
                    <div class="col-auto">
                        <select name="per_page" class="form-select" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 Per Page</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 Per Page</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 Per Page</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 Per Page</option>
                        </select>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Projects</th>
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
                                    <td><span class="badge bg-label-primary">{{ $item->projects_count }}</span></td>
                                    <td>{{ $item->order }}</td>
                                    <td>@include('admin.content._partials.status-toggle', ['item' => $item, 'route' => 'admin.project-categories.toggle-status'])
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.project-categories.edit', $item) }}"
                                            class="btn btn-sm btn-outline-primary"><i class="bx bx-edit"></i></a>
                                        <form action="{{ route('admin.project-categories.destroy', $item) }}" method="POST"
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