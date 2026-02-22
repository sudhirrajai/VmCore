@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Pages Management')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">CMS Pages</h5>
            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">Create New Page</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Published At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($pages as $page)
                        <tr>
                            <td><strong>{{ $page->title }}</strong></td>
                            <td>{{ $page->slug }}</td>
                            <td>
                                <span class="badge bg-label-{{ $page->status->value === 'published' ? 'success' : 'warning' }}">
                                    {{ ucfirst($page->status->value) }}
                                </span>
                            </td>
                            <td>{{ $page->published_at ? $page->published_at->format('Y-m-d H:i') : '-' }}</td>
                            <td>
                                <a class="btn btn-sm btn-info" href="{{ route('admin.pages.edit', $page) }}"><i
                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this page?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bx bx-trash me-1"></i>
                                        Delete</button>
                                </form>
                                <a href="{{ url($page->slug) }}" target="_blank" class="btn btn-sm btn-secondary"><i
                                        class="bx bx-link-external me-1"></i> View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No CMS pages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection