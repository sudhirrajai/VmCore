@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Newsletter Templates')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span>Newsletter /</span> Templates</h4>
            <a href="{{ route('admin.newsletter.templates.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Create Template
            </a>
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
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($templates as $template)
                            <tr>
                                <td>{{ $template->id }}</td>
                                <td><strong>{{ $template->name }}</strong></td>
                                <td>{{ $template->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-primary"
                                        href="{{ route('admin.newsletter.templates.edit', $template) }}" title="Edit">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.newsletter.templates.destroy', $template) }}" method="POST"
                                        class="d-inline-block">
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
                                <td colspan="4" class="text-center py-4">No templates found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $templates->links() }}
        </div>
    </div>
@endsection